<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Journal Security transaction aggregate.
 *
 * Security journal between sub-accounts.
 */
class JournalSecurity extends Aggregate
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
     * Sub-account from.
     */
    public InvestmentSubAccount $subAccountFrom;

    /**
     * Sub-account to.
     */
    public InvestmentSubAccount $subAccountTo;

    /**
     * Number of units.
     */
    public string $units;

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
            'SUBACCTFROM' => 'subAccountFrom',
            'SUBACCTTO' => 'subAccountTo',
            'UNITS' => 'units',
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

        if ($tagName === 'SUBACCTFROM' || $tagName === 'SUBACCTTO') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
