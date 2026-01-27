<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Messages Response V1 aggregate.
 *
 * Container for interbank transfer response messages.
 */
class InterBankMessagesResponseV1 extends Aggregate
{
    /**
     * All interbank transfer transaction responses.
     *
     * @var array<Aggregate>
     */
    public array $interBankTransactionResponses {
        get => $this->listItems;
    }

    /**
     * List of interbank transfer transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'INTERTRNRS',
        'RECINTERTRNRS',
        'INTERSYNCRS',
        'RECINTERSYNCRS',
    ];
}
