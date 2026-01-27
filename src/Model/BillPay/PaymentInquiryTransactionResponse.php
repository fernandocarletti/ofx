<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Payment Inquiry Transaction Response aggregate.
 *
 * Transaction wrapper for payment inquiry response.
 */
class PaymentInquiryTransactionResponse extends Aggregate
{
    /**
     * Transaction unique ID.
     */
    public string $transactionUniqueId;

    /**
     * Status.
     */
    public Status $status;

    /**
     * Client cookie (optional).
     */
    public ?string $clientCookie = null;

    /**
     * OFX extension (optional).
     */
    public ?string $ofxExtension = null;

    /**
     * Payment inquiry response.
     */
    public ?PaymentInquiryResponse $paymentInquiryResponse = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'TRNUID' => 'transactionUniqueId',
            'STATUS' => 'status',
            'CLTCOOKIE' => 'clientCookie',
            'OFXEXTENSION' => 'ofxExtension',
            'PMTINQRS' => 'paymentInquiryResponse',
        ];
    }
}
