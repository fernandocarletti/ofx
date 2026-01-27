<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\OpenOrder;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\SellType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Open Order Sell Mutual Fund aggregate.
 *
 * Represents an open sell order for mutual fund shares.
 */
class OpenOrderSellMutualFund extends Aggregate
{
    /**
     * Base open order details.
     */
    public OpenOrder $openOrder;

    /**
     * Sell type.
     */
    public SellType $sellType;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'OO' => 'openOrder',
            'SELLTYPE' => 'sellType',
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
        if ($child->getName() === 'SELLTYPE') {
            return SellType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
