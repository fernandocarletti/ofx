<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Wire Transfer Cancel Request aggregate.
 *
 * Request to cancel a wire transfer.
 */
class WireCancelRequest extends Aggregate
{
    /**
     * Server-assigned transaction ID of wire to cancel.
     */
    public string $serverTransactionId;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
        ];
    }
}
