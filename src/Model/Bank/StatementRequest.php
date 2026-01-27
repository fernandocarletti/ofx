<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;

/**
 * Statement Request aggregate.
 *
 * Contains bank statement request parameters.
 */
class StatementRequest extends Aggregate
{
    /**
     * Bank account to retrieve statement from.
     */
    public BankAccount $bankAccountFrom;

    /**
     * Include transactions filter.
     */
    public ?IncludeTransactions $includeTransactions = null;

    /**
     * Include statement images.
     */
    public ?bool $includeStatementImages = null;

    /**
     * Include pending transactions.
     */
    public ?bool $includePending = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BANKACCTFROM' => 'bankAccountFrom',
            'INCTRAN' => 'includeTransactions',
            'INCSTMTIMG' => 'includeStatementImages',
            'INCLUDEPENDING' => 'includePending',
        ];
    }
}
