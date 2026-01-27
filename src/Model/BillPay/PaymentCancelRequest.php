<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Cancel Request aggregate.
 *
 * Request to cancel an existing payment.
 */
class PaymentCancelRequest extends Aggregate
{
    /**
     * Server-assigned transaction ID of payment to cancel.
     */
    public string $serverTransactionId;

    /**
     * If true, also cancel all future instances of recurring payment.
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
