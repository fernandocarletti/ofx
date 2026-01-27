<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Period To Date aggregate.
 *
 * Contains period-to-date contribution and earnings information.
 */
class PeriodToDate extends Aggregate
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
