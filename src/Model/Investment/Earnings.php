<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Earnings aggregate.
 *
 * Contains earnings amounts by source.
 */
class Earnings extends Aggregate
{
    /**
     * Pre-tax earnings.
     */
    public ?string $preTax = null;

    /**
     * After-tax earnings.
     */
    public ?string $afterTax = null;

    /**
     * Match earnings.
     */
    public ?string $match = null;

    /**
     * Profit sharing earnings.
     */
    public ?string $profitSharing = null;

    /**
     * Rollover earnings.
     */
    public ?string $rollover = null;

    /**
     * Other vested earnings.
     */
    public ?string $otherVested = null;

    /**
     * Other non-vested earnings.
     */
    public ?string $otherNonVested = null;

    /**
     * Total earnings.
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
