<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Modification Request aggregate.
 *
 * Request to modify an existing payment.
 */
class PaymentModRequest extends Aggregate
{
    /**
     * Server-assigned transaction ID of payment to modify.
     */
    public string $serverTransactionId;

    /**
     * New payment information.
     */
    public PaymentInfo $paymentInfo;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'PMTINFO' => 'paymentInfo',
        ];
    }
}
