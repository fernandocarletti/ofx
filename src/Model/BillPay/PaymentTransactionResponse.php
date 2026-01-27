<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Payment Transaction Response aggregate.
 *
 * Transaction wrapper for payment response with transaction UUID and status.
 */
class PaymentTransactionResponse extends Aggregate
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
     * Payment response.
     */
    public ?PaymentResponse $paymentResponse = null;

    /**
     * Payment modification response.
     */
    public ?PaymentModResponse $paymentModificationResponse = null;

    /**
     * Payment cancellation response.
     */
    public ?PaymentCancelResponse $paymentCancellationResponse = null;

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
            'PMTRS' => 'paymentResponse',
            'PMTMODRS' => 'paymentModificationResponse',
            'PMTCANCRS' => 'paymentCancellationResponse',
        ];
    }
}
