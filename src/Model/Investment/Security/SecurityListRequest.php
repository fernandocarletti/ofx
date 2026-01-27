<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security List Request aggregate.
 *
 * Request for security list information.
 */
class SecurityListRequest extends Aggregate
{
    /**
     * All security requests.
     *
     * @var array<SecurityRequest>
     */
    public array $securityRequests {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of security requests.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'SECRQ',
    ];
}
