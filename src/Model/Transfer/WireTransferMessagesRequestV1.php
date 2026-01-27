<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Wire Transfer Messages Request V1 aggregate.
 *
 * Container for wire transfer request messages.
 */
class WireTransferMessagesRequestV1 extends Aggregate
{
    /**
     * All wire transfer transaction requests.
     *
     * @var array<Aggregate>
     */
    public array $wireTransferTransactionRequests {
        get => $this->listItems;
    }

    /**
     * List of wire transfer transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'WIRETRNRQ',
        'WIRESYNCRQ',
    ];
}
