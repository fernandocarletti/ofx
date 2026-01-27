<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\OptionSellType;
use Ofx\Enum\RelatedOptionType;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Sell Option transaction aggregate.
 */
class SellOption extends Aggregate
{
    /**
     * Investment sell details.
     */
    public InvestmentSell $investmentSell;

    /**
     * Option sell type.
     */
    public OptionSellType $optionSellType;

    /**
     * Shares per contract.
     */
    public ?int $sharesPerContract = null;

    /**
     * Related option transaction type.
     */
    public ?RelatedOptionType $relatedFinancialInstitutionTransactionId = null;

    /**
     * Related security ID.
     */
    public ?SecurityId $securityId = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVSELL' => 'investmentSell',
            'OPTSELLTYPE' => 'optionSellType',
            'SHPERCTRCT' => 'sharesPerContract',
            'RELFITID' => 'relatedFinancialInstitutionTransactionId',
            'SECID' => 'securityId',
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
        $tagName = $child->getName();

        if ($tagName === 'OPTSELLTYPE') {
            return OptionSellType::from(trim((string) $child));
        }

        if ($tagName === 'RELFITID') {
            return RelatedOptionType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
