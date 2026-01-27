<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security List aggregate.
 *
 * Contains a list of security information records.
 */
class SecurityList extends Aggregate
{
    /**
     * All securities.
     *
     * @var array<Aggregate>
     */
    public array $securities {
        get => $this->listItems;
    }

    /**
     * Stock info records only.
     *
     * @var array<StockInfo>
     */
    public array $stockInfo {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof StockInfo,
        );
    }

    /**
     * Debt info records only.
     *
     * @var array<DebtInfo>
     */
    public array $debtInfo {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof DebtInfo,
        );
    }

    /**
     * Mutual fund info records only.
     *
     * @var array<MutualFundInfo>
     */
    public array $mutualFundInfo {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof MutualFundInfo,
        );
    }

    /**
     * Option info records only.
     *
     * @var array<OptionInfo>
     */
    public array $optionInfo {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof OptionInfo,
        );
    }

    /**
     * Other info records only.
     *
     * @var array<OtherInfo>
     */
    public array $otherInfo {
        get => array_filter(
            $this->listItems,
            fn(Aggregate $item): bool => $item instanceof OtherInfo,
        );
    }

    /**
     * List of security info types that can be contained.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'DEBTINFO',
        'MFINFO',
        'OPTINFO',
        'OTHERINFO',
        'STOCKINFO',
    ];
}
