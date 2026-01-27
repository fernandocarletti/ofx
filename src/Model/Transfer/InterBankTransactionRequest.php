<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Transaction Request aggregate.
 *
 * Transaction wrapper for interbank transfer request.
 */
class InterBankTransactionRequest extends Aggregate
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
     * Interbank transfer request.
     */
    public ?InterBankRequest $interBankRequest = null;

    /**
     * Interbank transfer modification request.
     */
    public ?InterBankModRequest $interBankModificationRequest = null;

    /**
     * Interbank transfer cancellation request.
     */
    public ?InterBankCancelRequest $interBankCancellationRequest = null;

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
            'INTERRQ' => 'interBankRequest',
            'INTERMODRQ' => 'interBankModificationRequest',
            'INTERCANCRQ' => 'interBankCancellationRequest',
        ];
    }
}
