<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;

/**
 * Credit Card Account aggregate.
 *
 * Contains credit card account identification information.
 */
class CreditCardAccount extends Aggregate
{
    /**
     * Account number (credit card number).
     */
    public string $accountId;

    /**
     * Checksum for account ID (optional).
     */
    public ?string $accountKey = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'ACCTID' => 'accountId',
            'ACCTKEY' => 'accountKey',
        ];
    }
}
