<?php

declare(strict_types=1);

namespace Ofx\Model\Common;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Currency as CurrencyEnum;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * OFX Original Currency aggregate.
 *
 * Contains original currency information when transaction was in different currency.
 */
class OrigCurrency extends Aggregate
{
    /**
     * Ratio of statement currency to original currency.
     */
    public string $currate;

    /**
     * ISO-4217 currency code.
     */
    public CurrencyEnum $cursym;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CURRATE' => 'currate',
            'CURSYM' => 'cursym',
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

        if ($tagName === 'CURSYM') {
            return CurrencyEnum::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
