<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Response aggregate.
 *
 * Response to a payment request.
 */
class PaymentResponse extends Aggregate
{
    /**
     * Server-assigned payment ID.
     */
    public string $serverTransactionId;

    /**
     * Payee list ID (if payee was added to list).
     */
    public ?string $payeeListId = null;

    /**
     * Currency default.
     */
    public ?string $currencyDefault = null;

    /**
     * Payment information.
     */
    public PaymentInfo $paymentInfo;

    /**
     * Extended payment (optional).
     */
    public ?ExtendedPayment $extendedPayment = null;

    /**
     * Check number assigned by server.
     */
    public ?string $checkNumber = null;

    /**
     * Payment processing status.
     */
    public ?PaymentProcessingStatus $paymentProcessingStatus = null;

    /**
     * Reference server transaction ID (for modification).
     */
    public ?string $recurringServerTransactionId = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'PAYEELSTID' => 'payeeListId',
            'CURDEF' => 'currencyDefault',
            'PMTINFO' => 'paymentInfo',
            'EXTDPMT' => 'extendedPayment',
            'CHECKNUM' => 'checkNumber',
            'PMTPRCSTS' => 'paymentProcessingStatus',
            'RECSRVRTID' => 'recurringServerTransactionId',
        ];
    }
}
