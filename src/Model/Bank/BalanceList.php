<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Balance;

/**
 * Balance List aggregate.
 *
 * Contains a list of balance items.
 */
class BalanceList extends Aggregate
{
    /**
     * Balances.
     *
     * @var array<Balance>
     */
    public array $balances {
        get => array_filter(
            $this->listItems,
            fn($item) => $item instanceof Balance,
        );
    }

    /**
     * Balance list properties.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['BAL'];
}
