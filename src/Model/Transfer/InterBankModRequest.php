<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Modification Request aggregate.
 *
 * Request to modify an existing interbank transfer.
 */
class InterBankModRequest extends Aggregate
{
    /**
     * Server-assigned transaction ID of transfer to modify.
     */
    public string $serverTransactionId;

    /**
     * Updated transfer information.
     */
    public TransferInfo $transferInfo;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'XFERINFO' => 'transferInfo',
        ];
    }
}
