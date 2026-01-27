<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Inception To Date aggregate.
 *
 * Contains inception-to-date contribution and earnings information.
 */
class InceptionToDate extends Aggregate
{
    /**
     * Contributions.
     */
    public ?Contributions $contributions = null;

    /**
     * Withdrawals.
     */
    public ?Withdrawals $withdrawals = null;

    /**
     * Earnings.
     */
    public ?Earnings $earnings = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CONTRIBUTIONS' => 'contributions',
            'WITHDRAWALS' => 'withdrawals',
            'EARNINGS' => 'earnings',
        ];
    }
}
