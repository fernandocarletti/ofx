<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Include Transactions aggregate.
 *
 * Specifies which transactions to include in download.
 */
class IncludeTransactions extends Aggregate
{
    /**
     * Start date for transactions (optional).
     */
    public ?DateTimeImmutable $startDate = null;

    /**
     * End date for transactions (optional).
     */
    public ?DateTimeImmutable $endDate = null;

    /**
     * Include transactions flag.
     */
    public bool $include;

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
            'INCLUDE' => 'include',
        ];
    }
}
