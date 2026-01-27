<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Bank Transaction List aggregate.
 *
 * Contains a list of transactions with date range.
 */
class BankTransactionList extends Aggregate
{
    /**
     * Start date of the transaction list.
     */
    public DateTimeImmutable $startDate;

    /**
     * End date of the transaction list.
     */
    public DateTimeImmutable $endDate;

    /**
     * Transactions.
     *
     * @var array<Transaction>
     */
    public array $transactions {
        get => array_filter(
            $this->listItems,
            fn($item) => $item instanceof Transaction,
        );
    }

    /**
     * Transaction list properties.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['STMTTRN'];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DTSTART' => 'startDate',
            'DTEND' => 'endDate',
        ];
    }
}
