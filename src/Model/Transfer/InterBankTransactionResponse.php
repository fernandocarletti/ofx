<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Interbank Transfer Transaction Response aggregate.
 *
 * Transaction wrapper for interbank transfer response.
 */
class InterBankTransactionResponse extends Aggregate
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
     * Interbank transfer response.
     */
    public ?InterBankResponse $interBankResponse = null;

    /**
     * Interbank transfer modification response.
     */
    public ?InterBankModResponse $interBankModificationResponse = null;

    /**
     * Interbank transfer cancellation response.
     */
    public ?InterBankCancelResponse $interBankCancellationResponse = null;

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
            'INTERRS' => 'interBankResponse',
            'INTERMODRS' => 'interBankModificationResponse',
            'INTERCANCRS' => 'interBankCancellationResponse',
        ];
    }
}
