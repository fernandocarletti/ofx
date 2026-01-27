<?php

declare(strict_types=1);

namespace Ofx\Model\Signup;

use Ofx\Aggregate\Aggregate;

/**
 * Account Info Transaction Request aggregate.
 *
 * Wraps an account info request with transaction ID.
 */
class AccountInfoTransactionRequest extends Aggregate
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
     * Account info request.
     */
    public ?AccountInfoRequest $accountInfoRequest = null;

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
            'ACCTINFORQ' => 'accountInfoRequest',
        ];
    }
}
