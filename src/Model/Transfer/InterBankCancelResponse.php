<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Cancel Response aggregate.
 *
 * Response to an interbank transfer cancellation request.
 */
class InterBankCancelResponse extends Aggregate
{
    /**
     * Server-assigned transaction ID.
     */
    public string $serverTransactionId;

    /**
     * Whether pending transfers were also cancelled.
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
