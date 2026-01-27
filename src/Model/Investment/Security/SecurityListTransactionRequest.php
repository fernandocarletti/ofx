<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security List Transaction Request aggregate.
 *
 * Wraps a security list request with transaction ID.
 */
class SecurityListTransactionRequest extends Aggregate
{
    /**
     * Transaction unique ID.
     */
    public string $transactionUniqueId;

    /**
     * Client cookie.
     */
    public ?string $clientCookie = null;

    /**
     * Security list request.
     */
    public ?SecurityListRequest $securityListRequest = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'TRNUID' => 'transactionUniqueId',
            'CLTCOOKIE' => 'clientCookie',
            'SECLISTRQ' => 'securityListRequest',
        ];
    }
}
