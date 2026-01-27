<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use Ofx\Aggregate\Aggregate;

/**
 * Email Messages Response V1 aggregate.
 *
 * Container for email response messages.
 */
class EmailMessagesResponseV1 extends Aggregate
{
    /**
     * All email transaction responses.
     *
     * @var array<Aggregate>
     */
    public array $emailTransactionResponses {
        get => $this->listItems;
    }

    /**
     * List of email transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'MAILTRNRS',
        'MAILSYNCRS',
        'GETMIMETRNRS',
    ];
}
