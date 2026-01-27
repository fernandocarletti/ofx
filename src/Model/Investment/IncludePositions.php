<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Include Positions aggregate.
 *
 * Specifies whether positions should be included in the response.
 */
class IncludePositions extends Aggregate
{
    /**
     * Date/time for position information.
     */
    public ?DateTimeImmutable $asOfDate = null;

    /**
     * Include positions.
     */
    public ?bool $include = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DTASOF' => 'asOfDate',
            'INCLUDE' => 'include',
        ];
    }
}
