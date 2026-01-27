<?php

declare(strict_types=1);

namespace Ofx\Model\CreditCard;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Currency as CurrencyEnum;
use Ofx\Model\Bank\AvailableBalance;
use Ofx\Model\Bank\BalanceList;
use Ofx\Model\Bank\BankTransactionList;
use Ofx\Model\Bank\CreditCardAccount;
use Ofx\Model\Bank\LedgerBalance;
use Ofx\Model\Bank\RewardInfo;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Credit Card Statement Response aggregate.
 *
 * Contains credit card statement response data.
 */
class CreditCardStatementResponse extends Aggregate
{
    /**
     * Default currency for the statement.
     */
    public CurrencyEnum $currency;

    /**
     * Credit card account the statement is for.
     */
    public CreditCardAccount $creditCardAccount;

    /**
     * List of transactions in the statement.
     */
    public ?BankTransactionList $transactionList = null;

    /**
     * Ledger balance (total balance owed).
     */
    public ?LedgerBalance $ledgerBalance = null;

    /**
     * Available credit remaining.
     */
    public ?AvailableBalance $availableBalance = null;

    /**
     * Additional balance information.
     */
    public ?BalanceList $balanceList = null;

    /**
     * Reward program information.
     */
    public ?RewardInfo $rewardInfo = null;

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
            'CCACCTFROM' => 'creditCardAccount',
            'BANKTRANLIST' => 'transactionList',
            'LEDGERBAL' => 'ledgerBalance',
            'AVAILBAL' => 'availableBalance',
            'BALLIST' => 'balanceList',
            'REWARDINFO' => 'rewardInfo',
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
