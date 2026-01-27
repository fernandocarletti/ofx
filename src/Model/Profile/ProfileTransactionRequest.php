<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use Ofx\Aggregate\Aggregate;

/**
 * Profile Transaction Request aggregate.
 *
 * Wraps a profile request with transaction ID.
 */
class ProfileTransactionRequest extends Aggregate
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
     * Profile request.
     */
    public ?ProfileRequest $profileRequest = null;

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
            'PROFRQ' => 'profileRequest',
        ];
    }
}
