<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Withdrawals aggregate.
 *
 * Contains withdrawal amounts by source.
 */
class Withdrawals extends Aggregate
{
    /**
     * Pre-tax withdrawals.
     */
    public ?string $preTax = null;

    /**
     * After-tax withdrawals.
     */
    public ?string $afterTax = null;

    /**
     * Match withdrawals.
     */
    public ?string $match = null;

    /**
     * Profit sharing withdrawals.
     */
    public ?string $profitSharing = null;

    /**
     * Rollover withdrawals.
     */
    public ?string $rollover = null;

    /**
     * Other vested withdrawals.
     */
    public ?string $otherVested = null;

    /**
     * Other non-vested withdrawals.
     */
    public ?string $otherNonVested = null;

    /**
     * Total withdrawals.
     */
    public ?string $total = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'PRETAX' => 'preTax',
            'AFTERTAX' => 'afterTax',
            'MATCH' => 'match',
            'PROFITSHARING' => 'profitSharing',
            'ROLLOVER' => 'rollover',
            'OTHERVEST' => 'otherVested',
            'OTHERNONVEST' => 'otherNonVested',
            'TOTAL' => 'total',
        ];
    }
}
