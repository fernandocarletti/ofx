<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\OpenOrder;

use Ofx\Aggregate\Aggregate;

/**
 * Investment Open Order List aggregate.
 *
 * Contains a list of open (pending) orders.
 */
class InvestmentOpenOrderList extends Aggregate
{
    /**
     * All open orders.
     *
     * @var array<Aggregate>
     */
    public array $openOrders {
        get => $this->listItems;
    }

    /**
     * Buy orders only.
     *
     * @var array<Aggregate>
     */
    public array $buyOrders {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool =>
            $item instanceof OpenOrderBuyStock
                || $item instanceof OpenOrderBuyDebt
                || $item instanceof OpenOrderBuyMutualFund
                || $item instanceof OpenOrderBuyOption
                || $item instanceof OpenOrderBuyOther,
        );
    }

    /**
     * Sell orders only.
     *
     * @var array<Aggregate>
     */
    public array $sellOrders {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool =>
            $item instanceof OpenOrderSellStock
                || $item instanceof OpenOrderSellDebt
                || $item instanceof OpenOrderSellMutualFund
                || $item instanceof OpenOrderSellOption
                || $item instanceof OpenOrderSellOther,
        );
    }

    /**
     * Switch orders only.
     *
     * @var array<SwitchMutualFund>
     */
    public array $switchOrders {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof SwitchMutualFund,
        );
    }

    /**
     * List of open order types that can be contained.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'OOBUYDEBT',
        'OOBUYMF',
        'OOBUYOPT',
        'OOBUYOTHER',
        'OOBUYSTOCK',
        'OOSELLDEBT',
        'OOSELLMF',
        'OOSELLOPT',
        'OOSELLOTHER',
        'OOSELLSTOCK',
        'SWITCHMF',
    ];
}
