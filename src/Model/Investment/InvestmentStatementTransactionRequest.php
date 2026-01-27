<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;

/**
 * Investment Statement Transaction Request wrapper aggregate.
 *
 * Wraps investment statement request with transaction ID.
 */
class InvestmentStatementTransactionRequest extends Aggregate
{
    /**
     * Client-assigned globally unique transaction ID.
     */
    public string $transactionUniqueId;

    /**
     * Client ID (optional).
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
     * Investment statement request.
     */
    public InvestmentStatementRequest $investmentStatementRequest;

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
            'INVSTMTRQ' => 'investmentStatementRequest',
        ];
    }
}
