<?php

declare(strict_types=1);

namespace Ofx\Model\CreditCard;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\CreditCardAccount;
use Ofx\Model\Bank\IncludeTransactions;

/**
 * Credit Card Statement Request aggregate.
 *
 * Requests credit card statement data.
 */
class CreditCardStatementRequest extends Aggregate
{
    /**
     * Credit card account to retrieve statement from.
     */
    public CreditCardAccount $creditCardAccountFrom;

    /**
     * Include transactions filter.
     */
    public ?IncludeTransactions $includeTransactions = null;

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
            'CCACCTFROM' => 'creditCardAccountFrom',
            'INCTRAN' => 'includeTransactions',
            'INCLUDEPENDING' => 'includePending',
        ];
    }
}
