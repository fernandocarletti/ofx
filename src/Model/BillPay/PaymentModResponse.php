<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Modification Response aggregate.
 *
 * Response to a payment modification request.
 */
class PaymentModResponse extends Aggregate
{
    /**
     * Server-assigned transaction ID.
     */
    public string $serverTransactionId;

    /**
     * Updated payment information.
     */
    public PaymentInfo $paymentInfo;

    /**
     * Payment processing status.
     */
    public ?PaymentProcessingStatus $paymentProcessingStatus = null;

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
            'PMTPRCSTS' => 'paymentProcessingStatus',
        ];
    }
}
