<?php

declare(strict_types=1);

namespace Ofx\Model\Common;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Severity;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * OFX Status aggregate.
 *
 * Contains status information for responses including code, severity, and message.
 */
class Status extends Aggregate
{
    /**
     * Status code.
     * 0 = Success, non-zero indicates error.
     */
    public int $code;

    /**
     * Severity level.
     */
    public Severity $severity;

    /**
     * Status message (optional).
     */
    public ?string $message = null;

    /**
     * Check if status indicates success.
     *
     * @return bool True if successful
     */
    public function isSuccess(): bool
    {
        return $this->code === 0;
    }

    /**
     * Check if status indicates an error.
     *
     * @return bool True if error
     */
    public function isError(): bool
    {
        return $this->severity === Severity::ERROR;
    }

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CODE' => 'code',
            'SEVERITY' => 'severity',
            'MESSAGE' => 'message',
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

        if ($tagName === 'SEVERITY') {
            return Severity::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
