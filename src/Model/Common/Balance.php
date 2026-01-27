<?php

declare(strict_types=1);

namespace Ofx\Model\Common;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\BalanceType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * OFX Balance aggregate.
 *
 * Represents a balance item in BALLIST with name, description, type, and value.
 */
class Balance extends Aggregate
{
    /**
     * Balance name (identifier).
     */
    public string $name;

    /**
     * Balance description.
     */
    public string $description;

    /**
     * Balance type (DOLLAR, PERCENT, NUMBER).
     */
    public BalanceType $type;

    /**
     * Balance value.
     */
    public string $value;

    /**
     * Date/time balance is effective as of (optional).
     */
    public ?DateTimeImmutable $asOfDate = null;

    /**
     * Currency information (optional).
     */
    public ?Currency $currency = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'NAME' => 'name',
            'DESC' => 'description',
            'BALTYPE' => 'type',
            'VALUE' => 'value',
            'DTASOF' => 'asOfDate',
            'CURRENCY' => 'currency',
        ];
    }

    /**
     * Parse property value with special handling for enum.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        $tagName = $child->getName();

        if ($tagName === 'BALTYPE') {
            return BalanceType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
