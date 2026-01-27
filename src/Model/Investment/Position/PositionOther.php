<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Position;

use Ofx\Aggregate\Aggregate;

/**
 * Other Position aggregate.
 *
 * Represents a position in an "other" security type that
 * doesn't fit into the standard categories.
 */
class PositionOther extends Aggregate
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
