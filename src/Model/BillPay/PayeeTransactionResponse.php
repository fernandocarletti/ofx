<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Payee Transaction Response aggregate.
 *
 * Transaction wrapper for payee response.
 */
class PayeeTransactionResponse extends Aggregate
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
     * Payee response (add new payee).
     */
    public ?PayeeResponse $payeeResponse = null;

    /**
     * Payee modification response.
     */
    public ?PayeeModResponse $payeeModificationResponse = null;

    /**
     * Payee delete response.
     */
    public ?PayeeDeleteResponse $payeeDeletionResponse = null;

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
            'PAYEERS' => 'payeeResponse',
            'PAYEEMODRS' => 'payeeModificationResponse',
            'PAYEEDELRS' => 'payeeDeletionResponse',
        ];
    }
}
