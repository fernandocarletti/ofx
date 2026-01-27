<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Ledger Balance aggregate.
 *
 * Contains ledger balance information.
 */
class LedgerBalance extends Aggregate
{
    /**
     * Balance amount.
     */
    public string $amount;

    /**
     * Date the balance is effective as of.
     */
    public DateTimeImmutable $asOfDate;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BALAMT' => 'amount',
            'DTASOF' => 'asOfDate',
        ];
    }
}
