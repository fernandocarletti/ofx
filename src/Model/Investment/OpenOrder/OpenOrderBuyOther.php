<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\OpenOrder;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\BuyType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Open Order Buy Other aggregate.
 *
 * Represents an open buy order for other security types.
 */
class OpenOrderBuyOther extends Aggregate
{
    /**
     * Base open order details.
     */
    public OpenOrder $openOrder;

    /**
     * Buy type.
     */
    public BuyType $buyType;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'OO' => 'openOrder',
            'BUYTYPE' => 'buyType',
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
        if ($child->getName() === 'BUYTYPE') {
            return BuyType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
