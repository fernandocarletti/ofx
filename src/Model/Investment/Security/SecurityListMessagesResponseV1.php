<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security List Messages Response V1 aggregate.
 *
 * Container for security list response messages.
 */
class SecurityListMessagesResponseV1 extends Aggregate
{
    /**
     * Security list (can appear directly in response).
     */
    public ?SecurityList $securityList = null;

    /**
     * All security list transaction responses.
     *
     * @var array<SecurityListTransactionResponse>
     */
    public array $securityListTransactionResponses {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of security list transaction responses.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'SECLISTTRNRS',
    ];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECLIST' => 'securityList',
        ];
    }
}
