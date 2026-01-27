<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Contributions aggregate.
 *
 * Contains contribution amounts by source.
 */
class Contributions extends Aggregate
{
    /**
     * Pre-tax contributions.
     */
    public ?string $preTax = null;

    /**
     * After-tax contributions.
     */
    public ?string $afterTax = null;

    /**
     * Match contributions.
     */
    public ?string $match = null;

    /**
     * Profit sharing contributions.
     */
    public ?string $profitSharing = null;

    /**
     * Rollover contributions.
     */
    public ?string $rollover = null;

    /**
     * Other vested contributions.
     */
    public ?string $otherVested = null;

    /**
     * Other non-vested contributions.
     */
    public ?string $otherNonVested = null;

    /**
     * Total contributions.
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
