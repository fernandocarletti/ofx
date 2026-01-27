<?php

declare(strict_types=1);

namespace Ofx\Model\Common;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Currency as CurrencyEnum;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * OFX Currency aggregate.
 *
 * Contains currency code and exchange rate for currency conversion.
 */
class Currency extends Aggregate
{
    /**
     * ISO-4217 currency code.
     */
    public CurrencyEnum $cursym;

    /**
     * Ratio of statement currency to transaction currency.
     */
    public string $currate;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CURSYM' => 'cursym',
            'CURRATE' => 'currate',
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
