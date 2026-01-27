<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Profile Transaction Response aggregate.
 *
 * Wraps a profile response with status and transaction ID.
 */
class ProfileTransactionResponse extends Aggregate
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
     * Profile response.
     */
    public ?ProfileResponse $profileResponse = null;

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
            'PROFRS' => 'profileResponse',
        ];
    }
}
