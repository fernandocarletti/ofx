<?php

declare(strict_types=1);

namespace Ofx\Aggregate;

use DateTimeImmutable;
use Ofx\Exception\ValidationException;
use Ofx\Util\ModelRegistry;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Base class for all OFX aggregates.
 *
 * Aggregates are container elements that hold other aggregates and/or
 * data elements. They never contain text data directly.
 *
 * Subclasses define their structure using public properties with type hints
 * and the #[Element] attribute for data elements.
 *
 * @phpstan-consistent-constructor
 */
abstract class Aggregate
{
    /**
     * Read-only access to list items via property hook.
     *
     * @var array<Aggregate>
     */
    public array $items {
        get => $this->listItems;
    }

    /**
     * Count of list items via property hook.
     */
    public int $itemCount {
        get => \count($this->listItems);
    }

    /**
     * List items for aggregates that can contain multiple children of same type.
     *
     * @var array<Aggregate>
     */
    protected array $listItems = [];

    /**
     * Optional mutual exclusion groups - at most one of each group may be present.
     * Override in subclass to define constraints.
     *
     * @var array<array<string>>
     */
    protected static array $optionalMutexes = [];

    /**
     * Required mutual exclusion groups - exactly one of each group must be present.
     * Override in subclass to define constraints.
     *
     * @var array<array<string>>
     */
    protected static array $requiredMutexes = [];

    /**
     * Properties that accept list items (can appear multiple times).
     * Array of OFX tag names that should be collected into listItems.
     *
     * @var array<string>
     */
    protected static array $listProperties = [];

    /**
     * Create aggregate from SimpleXMLElement.
     *
     * @param SimpleXMLElement $element XML element
     *
     * @throws ValidationException If validation fails
     *
     * @return static Aggregate instance
     */
    public static function fromXml(SimpleXMLElement $element): static
    {
        $instance = new static();
        $instance->parseChildren($element);
        $instance->validate();

        return $instance;
    }

    /**
     * Parse child elements from XML.
     *
     * @param SimpleXMLElement $element XML element
     *
     * @throws ValidationException If unknown element encountered
     */
    protected function parseChildren(SimpleXMLElement $element): void
    {
        $reflection = new ReflectionClass($this);

        foreach ($element->children() as $child) {
            /** @var SimpleXMLElement $child */
            $tagName = $child->getName();
            $propertyName = $this->tagToPropertyName($tagName);

            // Check if this is a list property
            if ($this->isListProperty($tagName)) {
                $childAggregate = $this->parseChildElement($child);
                if ($childAggregate !== null) {
                    $this->listItems[] = $childAggregate;
                }
                continue;
            }

            // Try to find a property for this tag
            if (!$reflection->hasProperty($propertyName)) {
                throw new ValidationException(
                    \sprintf(
                        "Unknown element <%s> in %s",
                        $tagName,
                        static::class,
                    ),
                );
            }

            $property = $reflection->getProperty($propertyName);
            $value = $this->parsePropertyValue($child, $property);
            $property->setValue($this, $value);
        }
    }

    /**
     * Parse a child element to get its value.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        $type = $property->getType();

        if (!$type instanceof ReflectionNamedType) {
            // No type hint, return as string
            return trim((string) $child);
        }

        $typeName = $type->getName();

        // Check if it's an aggregate type
        if (is_subclass_of($typeName, self::class)) {
            return $typeName::fromXml($child);
        }

        // Check for registered model
        $modelClass = ModelRegistry::get($child->getName());
        if ($modelClass !== null && is_subclass_of($modelClass, self::class)) {
            return $modelClass::fromXml($child);
        }

        // Scalar value - get text content
        $textValue = trim((string) $child);

        if ($textValue === '' && $type->allowsNull()) {
            return null;
        }

        return match ($typeName) {
            'string' => $textValue,
            'int' => (int) $textValue,
            'float' => (float) $textValue,
            'bool' => $textValue === 'Y',
            'DateTimeImmutable', DateTimeImmutable::class => \Ofx\Util\DateTimeParser::parse($textValue),
            default => $textValue,
        };
    }

    /**
     * Parse a child element that could be an aggregate.
     *
     * @param SimpleXMLElement $child Child element
     *
     * @return Aggregate|null Parsed aggregate or null
     */
    protected function parseChildElement(SimpleXMLElement $child): ?self
    {
        $tagName = $child->getName();
        $modelClass = ModelRegistry::get($tagName);

        if ($modelClass === null) {
            throw new ValidationException("Unknown element <$tagName>");
        }

        if (!is_subclass_of($modelClass, self::class)) {
            throw new ValidationException("$modelClass is not an Aggregate");
        }

        return $modelClass::fromXml($child);
    }

    /**
     * Convert OFX tag name to property name.
     *
     * @param string $tagName OFX tag name (e.g., 'BANKACCTFROM')
     *
     * @return string Property name (e.g., 'bankAccountFrom')
     */
    protected function tagToPropertyName(string $tagName): string
    {
        // Direct mapping for common cases
        $mappings = $this->getTagMappings();
        if (isset($mappings[$tagName])) {
            return $mappings[$tagName];
        }

        // Default: lowercase
        return strtolower($tagName);
    }

    /**
     * Get tag name to property name mappings.
     * Override in subclass for custom mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [];
    }

    /**
     * Check if a tag is a list property.
     *
     * @param string $tagName OFX tag name
     *
     * @return bool True if tag represents list items
     */
    protected function isListProperty(string $tagName): bool
    {
        // Normalize to uppercase for case-insensitive matching (OFX V2 XML may have lowercase)
        $tagName = strtoupper($tagName);

        // Check if tag is in listProperties (supports both indexed array and associative formats)
        return \in_array($tagName, static::$listProperties, true)
            || \array_key_exists($tagName, static::$listProperties);
    }

    /**
     * Validate aggregate constraints.
     *
     * @throws ValidationException If validation fails
     */
    protected function validate(): void
    {
        $this->validateOptionalMutexes();
        $this->validateRequiredMutexes();
        $this->validateRequired();
    }

    /**
     * Validate optional mutual exclusions.
     *
     * @throws ValidationException If more than one of a mutex group is present
     */
    protected function validateOptionalMutexes(): void
    {
        foreach (static::$optionalMutexes as $mutex) {
            $present = [];
            foreach ($mutex as $property) {
                if ($this->propertyHasValue($property)) {
                    $present[] = $property;
                }
            }

            if (\count($present) > 1) {
                throw new ValidationException(
                    \sprintf(
                        '%s: at most one of [%s] may be present, found: %s',
                        static::class,
                        implode(', ', $mutex),
                        implode(', ', $present),
                    ),
                );
            }
        }
    }

    /**
     * Validate required mutual exclusions.
     *
     * @throws ValidationException If exactly one of a mutex group is not present
     */
    protected function validateRequiredMutexes(): void
    {
        foreach (static::$requiredMutexes as $mutex) {
            $present = [];
            foreach ($mutex as $property) {
                if ($this->propertyHasValue($property)) {
                    $present[] = $property;
                }
            }

            if (\count($present) !== 1) {
                throw new ValidationException(
                    \sprintf(
                        '%s: exactly one of [%s] must be present, found %d',
                        static::class,
                        implode(', ', $mutex),
                        \count($present),
                    ),
                );
            }
        }
    }

    /**
     * Validate required properties.
     *
     * @throws ValidationException If required property is missing
     */
    protected function validateRequired(): void
    {
        $reflection = new ReflectionClass($this);

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $type = $property->getType();

            if ($type instanceof ReflectionNamedType && !$type->allowsNull()) {
                if (!$property->isInitialized($this)) {
                    throw new ValidationException(
                        \sprintf(
                            '%s: required property %s is not set',
                            static::class,
                            $property->getName(),
                        ),
                    );
                }
            }
        }
    }

    /**
     * Check if a property has a non-null value.
     *
     * @param string $property Property name
     *
     * @return bool True if property has a value
     */
    protected function propertyHasValue(string $property): bool
    {
        if (!property_exists($this, $property)) {
            return false;
        }

        $reflection = new ReflectionProperty($this, $property);

        if (!$reflection->isInitialized($this)) {
            return false;
        }

        return $reflection->getValue($this) !== null;
    }

    /**
     * Add a list item.
     *
     * @param Aggregate $item Item to add
     */
    protected function addListItem(self $item): void
    {
        $this->listItems[] = $item;
    }
}
