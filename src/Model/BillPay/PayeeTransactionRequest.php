<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payee Transaction Request aggregate.
 *
 * Transaction wrapper for payee request.
 */
class PayeeTransactionRequest extends Aggregate
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
     * Payee request (add new payee).
     */
    public ?PayeeRequest $payeeRequest = null;

    /**
     * Payee modification request.
     */
    public ?PayeeModRequest $payeeModificationRequest = null;

    /**
     * Payee delete request.
     */
    public ?PayeeDeleteRequest $payeeDeletionRequest = null;

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
            'PAYEERQ' => 'payeeRequest',
            'PAYEEMODRQ' => 'payeeModificationRequest',
            'PAYEEDELRQ' => 'payeeDeletionRequest',
        ];
    }
}
