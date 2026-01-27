<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099 Messages Response V1 aggregate.
 *
 * Container for tax 1099 response messages.
 */
class Tax1099MessagesResponseV1 extends Aggregate
{
    /**
     * All tax 1099 transaction responses.
     *
     * @var array<Aggregate>
     */
    public array $tax1099TransactionResponses {
        get => $this->listItems;
    }

    /**
     * List of tax 1099 transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'TAX1099TRNRS',
    ];
}
