<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * FI Mutual Fund Asset Class aggregate.
 *
 * Contains asset allocation breakdown using FI-defined asset classes.
 */
class FiMutualFundAssetClass extends Aggregate
{
    /**
     * All FI portions.
     *
     * @var array<FiPortion>
     */
    public array $portions {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of FI-defined asset class portions.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'FIPORTION',
    ];
}
