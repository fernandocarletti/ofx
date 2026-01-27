<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Investment Account aggregate.
 *
 * Identifies an investment account.
 */
class InvestmentAccount extends Aggregate
{
    /**
     * Broker ID.
     */
    public string $brokerId;

    /**
     * Account ID at the broker.
     */
    public string $accountId;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BROKERID' => 'brokerId',
            'ACCTID' => 'accountId',
        ];
    }
}
