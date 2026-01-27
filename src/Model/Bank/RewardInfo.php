<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Reward Info aggregate.
 *
 * Contains credit card reward information.
 */
class RewardInfo extends Aggregate
{
    /**
     * Reward name.
     */
    public string $name;

    /**
     * Reward balance.
     */
    public string $rewardBalance;

    /**
     * Balance effective date.
     */
    public DateTimeImmutable $asOfDate;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'NAME' => 'name',
            'REWARDBAL' => 'rewardBalance',
            'DTASOF' => 'asOfDate',
        ];
    }
}
