<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use Ofx\Aggregate\Aggregate;

/**
 * Email Messages Request V1 aggregate.
 *
 * Container for email request messages.
 */
class EmailMessagesRequestV1 extends Aggregate
{
    /**
     * All email transaction requests.
     *
     * @var array<Aggregate>
     */
    public array $emailTransactionRequests {
        get => $this->listItems;
    }

    /**
     * List of email transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'MAILTRNRQ',
        'MAILSYNCRQ',
        'GETMIMETRNRQ',
    ];
}
