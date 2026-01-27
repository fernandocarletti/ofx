<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Position;

use Ofx\Aggregate\Aggregate;

/**
 * Investment Position List aggregate.
 *
 * Contains a list of investment positions (holdings).
 */
class InvestmentPositionList extends Aggregate
{
    /**
     * All positions.
     *
     * @var array<Aggregate>
     */
    public array $positions {
        get => $this->listItems;
    }

    /**
     * Stock positions only.
     *
     * @var array<PositionStock>
     */
    public array $stockPositions {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof PositionStock,
        );
    }

    /**
     * Debt positions only.
     *
     * @var array<PositionDebt>
     */
    public array $debtPositions {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof PositionDebt,
        );
    }

    /**
     * Mutual fund positions only.
     *
     * @var array<PositionMutualFund>
     */
    public array $mutualFundPositions {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof PositionMutualFund,
        );
    }

    /**
     * Option positions only.
     *
     * @var array<PositionOption>
     */
    public array $optionPositions {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof PositionOption,
        );
    }

    /**
     * Other positions only.
     *
     * @var array<PositionOther>
     */
    public array $otherPositions {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof PositionOther,
        );
    }

    /**
     * List of position types that can be contained.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'POSDEBT',
        'POSMF',
        'POSOPT',
        'POSOTHER',
        'POSSTOCK',
    ];
}
