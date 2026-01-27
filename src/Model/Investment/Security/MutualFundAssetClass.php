<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Mutual Fund Asset Class aggregate.
 *
 * Contains asset allocation breakdown using standard OFX asset classes.
 */
class MutualFundAssetClass extends Aggregate
{
    /**
     * All portions.
     *
     * @var array<Portion>
     */
    public array $portions {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of asset class portions.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'PORTION',
    ];
}
