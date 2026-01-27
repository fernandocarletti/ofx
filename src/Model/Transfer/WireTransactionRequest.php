<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Wire Transfer Transaction Request aggregate.
 *
 * Transaction wrapper for wire transfer request.
 */
class WireTransactionRequest extends Aggregate
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
     * Wire transfer request.
     */
    public ?WireRequest $wireRequest = null;

    /**
     * Wire transfer cancellation request.
     */
    public ?WireCancelRequest $wireCancellationRequest = null;

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
            'WIRERQ' => 'wireRequest',
            'WIRECANCRQ' => 'wireCancellationRequest',
        ];
    }
}
