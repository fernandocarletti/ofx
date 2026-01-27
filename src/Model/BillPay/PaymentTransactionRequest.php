<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Transaction Request aggregate.
 *
 * Transaction wrapper for payment request with transaction UUID.
 */
class PaymentTransactionRequest extends Aggregate
{
    /**
     * Transaction unique ID.
     */
    public string $transactionUniqueId;

    /**
     * Client cookie (optional).
     */
    public ?string $clientCookie = null;

    /**
     * Transaction authorization number (optional).
     */
    public ?string $transactionAuthorizationNumber = null;

    /**
     * OFX extension (optional).
     */
    public ?string $ofxExtension = null;

    /**
     * Payment request.
     */
    public ?PaymentRequest $paymentRequest = null;

    /**
     * Payment modification request.
     */
    public ?PaymentModRequest $paymentModificationRequest = null;

    /**
     * Payment cancellation request.
     */
    public ?PaymentCancelRequest $paymentCancellationRequest = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'TRNUID' => 'transactionUniqueId',
            'CLTCOOKIE' => 'clientCookie',
            'TAN' => 'transactionAuthorizationNumber',
            'OFXEXTENSION' => 'ofxExtension',
            'PMTRQ' => 'paymentRequest',
            'PMTMODRQ' => 'paymentModificationRequest',
            'PMTCANCRQ' => 'paymentCancellationRequest',
        ];
    }
}
