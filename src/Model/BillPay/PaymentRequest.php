<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Request aggregate.
 *
 * Request to create a new payment.
 */
class PaymentRequest extends Aggregate
{
    /**
     * Payment information.
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
            'PMTINFO' => 'paymentInfo',
        ];
    }
}
