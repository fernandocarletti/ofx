<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Position;

use Ofx\Aggregate\Aggregate;

/**
 * Debt Position aggregate.
 *
 * Represents a position in a debt security (bond, etc.).
 */
class PositionDebt extends Aggregate
{
    /**
     * Base investment position details.
     */
    public InvestmentPosition $investmentPosition;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVPOS' => 'investmentPosition',
        ];
    }
}
