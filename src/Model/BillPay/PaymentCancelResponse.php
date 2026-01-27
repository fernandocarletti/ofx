<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Cancel Response aggregate.
 *
 * Response to a payment cancellation request.
 */
class PaymentCancelResponse extends Aggregate
{
    /**
     * Server-assigned transaction ID.
     */
    public string $serverTransactionId;

    /**
     * Whether pending payments were also cancelled.
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
