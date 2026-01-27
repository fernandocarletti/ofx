<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Enum\RelatedOptionType;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Closure Option transaction aggregate.
 *
 * Option expiration or closure.
 */
class ClosureOption extends Aggregate
{
    /**
     * Investment transaction details.
     */
    public InvestmentTransaction $investmentTransaction;

    /**
     * Security ID.
     */
    public SecurityId $securityId;

    /**
     * Option action.
     */
    public string $optionAction;

    /**
     * Number of units.
     */
    public string $units;

    /**
     * Shares per contract.
     */
    public int $sharesPerContract;

    /**
     * Sub-account for security.
     */
    public InvestmentSubAccount $subAccountSecurity;

    /**
     * Related option transaction type.
     */
    public ?RelatedOptionType $relatedFinancialInstitutionTransactionId = null;

    /**
     * Gain.
     */
    public ?string $gain = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVTRAN' => 'investmentTransaction',
            'SECID' => 'securityId',
            'OPTACTION' => 'optionAction',
            'UNITS' => 'units',
            'SHPERCTRCT' => 'sharesPerContract',
            'SUBACCTSEC' => 'subAccountSecurity',
            'RELFITID' => 'relatedFinancialInstitutionTransactionId',
            'GAIN' => 'gain',
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

        if ($tagName === 'SUBACCTSEC') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        if ($tagName === 'RELFITID') {
            return RelatedOptionType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
