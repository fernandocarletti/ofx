<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Investment 401k Summary aggregate.
 *
 * Contains 401k summary information.
 */
class Investment401kSummary extends Aggregate
{
    /**
     * Year to date information.
     */
    public ?YearToDate $yearToDate = null;

    /**
     * Inception to date information.
     */
    public ?InceptionToDate $inceptionToDate = null;

    /**
     * Period to date information.
     */
    public ?PeriodToDate $periodToDate = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'YEARTODATE' => 'yearToDate',
            'INCEPTODATE' => 'inceptionToDate',
            'PERIODTODATE' => 'periodToDate',
        ];
    }
}
