<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Wire Transfer Transaction Response aggregate.
 *
 * Transaction wrapper for wire transfer response.
 */
class WireTransactionResponse extends Aggregate
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
     * Wire transfer response.
     */
    public ?WireResponse $wireResponse = null;

    /**
     * Wire transfer cancellation response.
     */
    public ?WireCancelResponse $wireCancellationResponse = null;

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
            'WIRERS' => 'wireResponse',
            'WIRECANCRS' => 'wireCancellationResponse',
        ];
    }
}
