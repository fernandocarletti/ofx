<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Inquiry Request aggregate.
 *
 * Request to get status of a payment.
 */
class PaymentInquiryRequest extends Aggregate
{
    /**
     * Server-assigned transaction ID of payment to query.
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
