<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Investment 401k Balance aggregate.
 *
 * Contains 401k balance information.
 */
class Investment401kBalance extends Aggregate
{
    /**
     * Cash balance.
     */
    public ?string $cashBalance = null;

    /**
     * Pre-tax balance.
     */
    public ?string $preTax = null;

    /**
     * After-tax balance.
     */
    public ?string $afterTax = null;

    /**
     * Match balance.
     */
    public ?string $match = null;

    /**
     * Profit sharing balance.
     */
    public ?string $profitSharing = null;

    /**
     * Rollover balance.
     */
    public ?string $rollover = null;

    /**
     * Other vested balance.
     */
    public ?string $otherVested = null;

    /**
     * Other non-vested balance.
     */
    public ?string $otherNonVested = null;

    /**
     * Total balance.
     */
    public ?string $total = null;

    /**
     * List property for balance items.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['BAL'];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CASHBAL' => 'cashBalance',
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
