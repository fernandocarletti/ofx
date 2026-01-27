<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Payment Processing Status aggregate.
 *
 * Contains the processing status of a payment.
 */
class PaymentProcessingStatus extends Aggregate
{
    /**
     * Payment processing status code.
     * Values: WILLPROCESSON, PROCESSEDON, FAILEDON, CANCELEDON, NOFUNDSON.
     */
    public ?string $paymentProcessingCode = null;

    /**
     * Date associated with the processing status.
     */
    public ?DateTimeImmutable $paymentProcessingDate = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'PMTPRCCODE' => 'paymentProcessingCode',
            'DTPMTPRC' => 'paymentProcessingDate',
        ];
    }
}
