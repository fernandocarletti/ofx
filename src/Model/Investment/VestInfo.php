<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Vest Info aggregate.
 *
 * Contains vesting schedule information.
 */
class VestInfo extends Aggregate
{
    /**
     * Vesting date.
     */
    public ?DateTimeImmutable $vestDate = null;

    /**
     * Vesting percentage.
     */
    public ?string $vestPercent = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'VESTDATE' => 'vestDate',
            'VESTPCT' => 'vestPercent',
        ];
    }
}
