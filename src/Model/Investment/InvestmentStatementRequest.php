<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\IncludeTransactions;

/**
 * Investment Statement Request aggregate.
 *
 * Requests investment statement data.
 */
class InvestmentStatementRequest extends Aggregate
{
    /**
     * Investment account from.
     */
    public InvestmentAccount $investmentAccountFrom;

    /**
     * Include transactions specification.
     */
    public ?IncludeTransactions $includeTransactions = null;

    /**
     * Include open orders.
     */
    public ?bool $includeOpenOrders = null;

    /**
     * Include positions specification.
     */
    public ?IncludePositions $includePositions = null;

    /**
     * Include balance.
     */
    public ?bool $includeBalance = null;

    /**
     * Include 401k info.
     */
    public ?bool $include401k = null;

    /**
     * Include 401k balance.
     */
    public ?bool $include401kBalance = null;

    /**
     * Include contribution info.
     */
    public ?bool $includeTransactionImages = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVACCTFROM' => 'investmentAccountFrom',
            'INCTRAN' => 'includeTransactions',
            'INCOO' => 'includeOpenOrders',
            'INCPOS' => 'includePositions',
            'INCBAL' => 'includeBalance',
            'INC401K' => 'include401k',
            'INC401KBAL' => 'include401kBalance',
            'INCTRANIMG' => 'includeTransactionImages',
        ];
    }
}
