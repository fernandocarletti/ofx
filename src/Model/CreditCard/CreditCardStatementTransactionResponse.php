<?php

declare(strict_types=1);

namespace Ofx\Model\CreditCard;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Credit Card Statement Transaction Response wrapper aggregate.
 *
 * Wraps credit card statement response with transaction ID and status.
 */
class CreditCardStatementTransactionResponse extends Aggregate
{
    /**
     * Client-assigned globally unique transaction ID.
     */
    public string $transactionUniqueId;

    /**
     * Status of the transaction.
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
     * Credit card statement response.
     */
    public ?CreditCardStatementResponse $creditCardStatementResponse = null;

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
            'CCSTMTRS' => 'creditCardStatementResponse',
        ];
    }
}
