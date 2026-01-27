<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Bill Pay Messages Request V1 aggregate.
 *
 * Container for bill pay request messages.
 */
class BillPayMessagesRequestV1 extends Aggregate
{
    /**
     * All bill pay transaction requests.
     *
     * @var array<Aggregate>
     */
    public array $billPayTransactionRequests {
        get => $this->listItems;
    }

    /**
     * List of bill pay transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'PMTTRNRQ',
        'RECPMTTRNRQ',
        'PMTINQTRNRQ',
        'PMTMAILTRNRQ',
        'PMTMAILSYNCRQ',
        'PMTSYNCRQ',
        'RECPMTSYNCRQ',
        'PAYEETRNRQ',
        'PAYEESYNCRQ',
    ];
}
