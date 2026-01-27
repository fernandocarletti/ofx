<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Bill Pay Messages Response V1 aggregate.
 *
 * Container for bill pay response messages.
 */
class BillPayMessagesResponseV1 extends Aggregate
{
    /**
     * All bill pay transaction responses.
     *
     * @var array<Aggregate>
     */
    public array $billPayTransactionResponses {
        get => $this->listItems;
    }

    /**
     * List of bill pay transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'PMTTRNRS',
        'RECPMTTRNRS',
        'PMTINQTRNRS',
        'PMTMAILTRNRS',
        'PMTMAILSYNCRS',
        'PMTSYNCRS',
        'RECPMTSYNCRS',
        'PAYEETRNRS',
        'PAYEESYNCRS',
    ];
}
