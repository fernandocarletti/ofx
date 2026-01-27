<?php

declare(strict_types=1);

namespace Ofx\Model\Signup;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Account Info Transaction Response aggregate.
 *
 * Wraps an account info response with status and transaction ID.
 */
class AccountInfoTransactionResponse extends Aggregate
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
     * Account info response.
     */
    public ?AccountInfoResponse $accountInfoResponse = null;

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
            'ACCTINFORS' => 'accountInfoResponse',
        ];
    }
}
