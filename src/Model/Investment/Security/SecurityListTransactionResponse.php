<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Security List Transaction Response aggregate.
 *
 * Wraps a security list response with status and transaction ID.
 */
class SecurityListTransactionResponse extends Aggregate
{
    /**
     * Transaction unique ID.
     */
    public string $transactionUniqueId;

    /**
     * Status of the transaction.
     */
    public Status $status;

    /**
     * Client cookie.
     */
    public ?string $clientCookie = null;

    /**
     * Security list response.
     */
    public ?SecurityListResponse $securityListResponse = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'TRNUID' => 'transactionUniqueId',
            'STATUS' => 'status',
            'CLTCOOKIE' => 'clientCookie',
            'SECLISTRS' => 'securityListResponse',
        ];
    }
}
