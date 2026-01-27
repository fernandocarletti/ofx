<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Wire Transfer Messages Response V1 aggregate.
 *
 * Container for wire transfer response messages.
 */
class WireTransferMessagesResponseV1 extends Aggregate
{
    /**
     * All wire transfer transaction responses.
     *
     * @var array<Aggregate>
     */
    public array $wireTransferTransactionResponses {
        get => $this->listItems;
    }

    /**
     * List of wire transfer transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'WIRETRNRS',
        'WIRESYNCRS',
    ];
}
