<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Mail Transaction Response aggregate.
 *
 * Transaction wrapper for mail response with transaction UUID and status.
 */
class MailTransactionResponse extends Aggregate
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
     * Mail response.
     */
    public ?MailResponse $mailResponse = null;

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
            'MAILRS' => 'mailResponse',
        ];
    }
}
