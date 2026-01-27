<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Investment Transaction aggregate.
 *
 * Base transaction information for investment transactions.
 */
class InvestmentTransaction extends Aggregate
{
    /**
     * Unique FI-assigned transaction ID.
     */
    public string $financialInstitutionTransactionId;

    /**
     * Server-assigned transaction ID.
     */
    public ?string $serverTransactionId = null;

    /**
     * Trade date.
     */
    public DateTimeImmutable $tradeDate;

    /**
     * Settlement date.
     */
    public ?DateTimeImmutable $settleDate = null;

    /**
     * Reversal FI-assigned transaction ID.
     */
    public ?string $reversalFinancialInstitutionTransactionId = null;

    /**
     * Memo.
     */
    public ?string $memo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'FITID' => 'financialInstitutionTransactionId',
            'SRVRTID' => 'serverTransactionId',
            'DTTRADE' => 'tradeDate',
            'DTSETTLE' => 'settleDate',
            'REVERSALFITID' => 'reversalFinancialInstitutionTransactionId',
            'MEMO' => 'memo',
        ];
    }
}
