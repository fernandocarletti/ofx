<?php

declare(strict_types=1);

namespace Ofx\Model\Signup;

use Ofx\Aggregate\Aggregate;

/**
 * Signup Messages Response V1 aggregate.
 *
 * Container for signup response messages.
 */
class SignupMessagesResponseV1 extends Aggregate
{
    /**
     * All account info transaction responses.
     *
     * @var array<AccountInfoTransactionResponse>
     */
    public array $accountInfoTransactionResponses {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of account info transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'ACCTINFOTRNRS',
    ];
}
