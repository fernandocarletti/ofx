<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\InvestmentSubAccount;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Journal Fund transaction aggregate.
 *
 * Cash journal between sub-accounts.
 */
class JournalFund extends Aggregate
{
    /**
     * Investment transaction details.
     */
    public InvestmentTransaction $investmentTransaction;

    /**
     * Sub-account from.
     */
    public InvestmentSubAccount $subAccountFrom;

    /**
     * Sub-account to.
     */
    public InvestmentSubAccount $subAccountTo;

    /**
     * Total amount.
     */
    public string $total;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVTRAN' => 'investmentTransaction',
            'SUBACCTFROM' => 'subAccountFrom',
            'SUBACCTTO' => 'subAccountTo',
            'TOTAL' => 'total',
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
