<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Inquiry Response aggregate.
 *
 * Response to a payment inquiry request.
 */
class PaymentInquiryResponse extends Aggregate
{
    /**
     * Server-assigned transaction ID.
     */
    public string $serverTransactionId;

    /**
     * Payment processing status.
     */
    public PaymentProcessingStatus $paymentProcessingStatus;

    /**
     * Check number (if payment was by check).
     */
    public ?string $checkNumber = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'PMTPRCSTS' => 'paymentProcessingStatus',
            'CHECKNUM' => 'checkNumber',
        ];
    }
}
