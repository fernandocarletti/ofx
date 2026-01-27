<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Extended 1099-B Information aggregate.
 *
 * Extended information for 1099-B broker transactions.
 */
class ExtendedBInfo extends Aggregate
{
    /**
     * All proceeds details.
     *
     * @var array<ProcDet>
     */
    public array $proceedsDetails {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of proceeds detail items.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'PROCDET_V100',
    ];
}
