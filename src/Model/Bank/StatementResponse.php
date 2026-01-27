<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Currency as CurrencyEnum;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Statement Response aggregate.
 *
 * Contains bank statement response data.
 */
class StatementResponse extends Aggregate
{
    /**
     * Default currency for the statement.
     */
    public CurrencyEnum $currency;

    /**
     * Bank account the statement is for.
     */
    public BankAccount $bankAccount;

    /**
     * List of transactions in the statement.
     */
    public ?BankTransactionList $transactionList = null;

    /**
     * Ledger balance (total balance).
     */
    public ?LedgerBalance $ledgerBalance = null;

    /**
     * Available balance (spendable amount).
     */
    public ?AvailableBalance $availableBalance = null;

    /**
     * Additional balance information.
     */
    public ?BalanceList $balanceList = null;

    /**
     * Marketing information from the financial institution.
     */
    public ?string $marketingInfo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CURDEF' => 'currency',
            'BANKACCTFROM' => 'bankAccount',
            'BANKTRANLIST' => 'transactionList',
            'LEDGERBAL' => 'ledgerBalance',
            'AVAILBAL' => 'availableBalance',
            'BALLIST' => 'balanceList',
            'MKTGINFO' => 'marketingInfo',
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
        $tagName = $child->getName();

        if ($tagName === 'CURDEF') {
            return CurrencyEnum::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
