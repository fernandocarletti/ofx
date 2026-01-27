<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security List Messages Request V1 aggregate.
 *
 * Container for security list request messages.
 */
class SecurityListMessagesRequestV1 extends Aggregate
{
    /**
     * All security list transaction requests.
     *
     * @var array<SecurityListTransactionRequest>
     */
    public array $securityListTransactionRequests {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of security list transaction requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'SECLISTTRNRQ',
    ];
}
