<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099 Messages Request V1 aggregate.
 *
 * Container for tax 1099 request messages.
 */
class Tax1099MessagesRequestV1 extends Aggregate
{
    /**
     * All tax 1099 transaction requests.
     *
     * @var array<Aggregate>
     */
    public array $tax1099TransactionRequests {
        get => $this->listItems;
    }

    /**
     * List of tax 1099 transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'TAX1099TRNRQ',
    ];
}
