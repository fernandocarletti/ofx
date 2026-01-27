<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Messages Request V1 aggregate.
 *
 * Container for interbank transfer request messages.
 */
class InterBankMessagesRequestV1 extends Aggregate
{
    /**
     * All interbank transfer transaction requests.
     *
     * @var array<Aggregate>
     */
    public array $interBankTransactionRequests {
        get => $this->listItems;
    }

    /**
     * List of interbank transfer transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'INTERTRNRQ',
        'RECINTERTRNRQ',
        'INTERSYNCRQ',
        'RECINTERSYNCRQ',
    ];
}
