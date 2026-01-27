<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Model\Bank\Transaction;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Investment Bank Transaction aggregate.
 *
 * A banking transaction within an investment account.
 */
class InvestmentBankTransaction extends Aggregate
{
    /**
     * Bank transaction details.
     */
    public Transaction $statementTransaction;

    /**
     * Sub-account type.
     */
    public InvestmentSubAccount $subAccountFund;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'STMTTRN' => 'statementTransaction',
            'SUBACCTFUND' => 'subAccountFund',
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
        if ($child->getName() === 'SUBACCTFUND') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
