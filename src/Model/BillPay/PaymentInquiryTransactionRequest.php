<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payment Inquiry Transaction Request aggregate.
 *
 * Transaction wrapper for payment inquiry request.
 */
class PaymentInquiryTransactionRequest extends Aggregate
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
     * Payment inquiry request.
     */
    public ?PaymentInquiryRequest $paymentInquiryRequest = null;

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
            'PMTINQRQ' => 'paymentInquiryRequest',
        ];
    }
}
