<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use Ofx\Aggregate\Aggregate;

/**
 * Profile Messages Response V1 aggregate.
 *
 * Container for profile response messages.
 */
class ProfileMessagesResponseV1 extends Aggregate
{
    /**
     * All profile transaction responses.
     *
     * @var array<ProfileTransactionResponse>
     */
    public array $profileTransactionResponses {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of profile transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'PROFTRNRS',
    ];
}
