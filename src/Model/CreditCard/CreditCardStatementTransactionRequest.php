<?php

declare(strict_types=1);

namespace Ofx\Model\CreditCard;

use Ofx\Aggregate\Aggregate;

/**
 * Credit Card Statement Transaction Request wrapper aggregate.
 *
 * Wraps credit card statement request with transaction ID.
 */
class CreditCardStatementTransactionRequest extends Aggregate
{
    /**
     * Client-assigned globally unique transaction ID.
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
     * Credit card statement request.
     */
    public CreditCardStatementRequest $creditCardStatementRequest;

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
            'CCSTMTRQ' => 'creditCardStatementRequest',
        ];
    }
}
