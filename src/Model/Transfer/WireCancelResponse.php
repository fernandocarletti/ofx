<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Wire Transfer Cancel Response aggregate.
 *
 * Response to a wire transfer cancellation request.
 */
class WireCancelResponse extends Aggregate
{
    /**
     * Server-assigned transaction ID.
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
