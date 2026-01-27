<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Cancel Request aggregate.
 *
 * Request to cancel an existing interbank transfer.
 */
class InterBankCancelRequest extends Aggregate
{
    /**
     * Server-assigned transaction ID of transfer to cancel.
     */
    public string $serverTransactionId;

    /**
     * If true, also cancel all future instances of recurring transfer.
     */
    public ?bool $cancelPending = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'CANPENDING' => 'cancelPending',
        ];
    }
}
