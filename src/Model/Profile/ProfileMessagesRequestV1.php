<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use Ofx\Aggregate\Aggregate;

/**
 * Profile Messages Request V1 aggregate.
 *
 * Container for profile request messages.
 */
class ProfileMessagesRequestV1 extends Aggregate
{
    /**
     * All profile transaction requests.
     *
     * @var array<ProfileTransactionRequest>
     */
    public array $profileTransactionRequests {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of profile transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'PROFTRNRQ',
    ];
}
