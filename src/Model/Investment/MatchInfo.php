<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Match Info aggregate.
 *
 * Contains employer match information.
 */
class MatchInfo extends Aggregate
{
    /**
     * Match percentage.
     */
    public ?string $matchPercent = null;

    /**
     * Maximum match amount.
     */
    public ?string $maxMatchAmount = null;

    /**
     * Maximum match percentage.
     */
    public ?string $maxMatchPercent = null;

    /**
     * Start date for match.
     */
    public ?DateTimeImmutable $startDate = null;

    /**
     * Base match amount.
     */
    public ?string $baseMatchAmount = null;

    /**
     * Base match percentage.
     */
    public ?string $baseMatchPercent = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'MATCHPCT' => 'matchPercent',
            'MAXMATCHAMT' => 'maxMatchAmount',
            'MAXMATCHPCT' => 'maxMatchPercent',
            'STARTDATE' => 'startDate',
            'BASEMATCHAMT' => 'baseMatchAmount',
            'BASEMATCHPCT' => 'baseMatchPercent',
        ];
    }
}
