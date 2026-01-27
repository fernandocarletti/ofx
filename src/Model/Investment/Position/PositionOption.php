<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Position;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Investment\Security\SecurityId;

/**
 * Option Position aggregate.
 *
 * Represents a position in an option security.
 */
class PositionOption extends Aggregate
{
    /**
     * Base investment position details.
     */
    public InvestmentPosition $investmentPosition;

    /**
     * Security ID of the underlying security.
     */
    public ?SecurityId $securityId = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVPOS' => 'investmentPosition',
            'SECID' => 'securityId',
        ];
    }
}
