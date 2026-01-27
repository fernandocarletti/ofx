<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\OptionBuyType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Buy Option transaction aggregate.
 */
class BuyOption extends Aggregate
{
    /**
     * Investment buy details.
     */
    public InvestmentBuy $investmentBuy;

    /**
     * Option buy type.
     */
    public OptionBuyType $optionBuyType;

    /**
     * Shares per contract.
     */
    public ?int $sharesPerContract = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVBUY' => 'investmentBuy',
            'OPTBUYTYPE' => 'optionBuyType',
            'SHPERCTRCT' => 'sharesPerContract',
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
        if ($child->getName() === 'OPTBUYTYPE') {
            return OptionBuyType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
