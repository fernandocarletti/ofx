<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\OpenOrder;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\OptionSellType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Open Order Sell Option aggregate.
 *
 * Represents an open sell order for options.
 */
class OpenOrderSellOption extends Aggregate
{
    /**
     * Base open order details.
     */
    public OpenOrder $openOrder;

    /**
     * Option sell type.
     */
    public OptionSellType $optionSellType;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'OO' => 'openOrder',
            'OPTSELLTYPE' => 'optionSellType',
        ];
    }

    /**
     * Parse property value with special handling for enums.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        if ($child->getName() === 'OPTSELLTYPE') {
            return OptionSellType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
