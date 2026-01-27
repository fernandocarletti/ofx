<?php

declare(strict_types=1);

namespace Ofx\Model\Signup;

use Ofx\Aggregate\Aggregate;

/**
 * Signup Messages Request V1 aggregate.
 *
 * Container for signup request messages.
 */
class SignupMessagesRequestV1 extends Aggregate
{
    /**
     * All account info transaction requests.
     *
     * @var array<AccountInfoTransactionRequest>
     */
    public array $accountInfoTransactionRequests {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of account info transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'ACCTINFOTRNRQ',
    ];
}
