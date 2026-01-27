<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\OpenOrder;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\OptionBuyType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Open Order Buy Option aggregate.
 *
 * Represents an open buy order for options.
 */
class OpenOrderBuyOption extends Aggregate
{
    /**
     * Base open order details.
     */
    public OpenOrder $openOrder;

    /**
     * Option buy type.
     */
    public OptionBuyType $optionBuyType;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'OO' => 'openOrder',
            'OPTBUYTYPE' => 'optionBuyType',
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
        if ($child->getName() === 'OPTBUYTYPE') {
            return OptionBuyType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
