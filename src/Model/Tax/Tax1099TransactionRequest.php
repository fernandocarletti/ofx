<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099 Transaction Request aggregate.
 *
 * Transaction wrapper for tax 1099 request.
 */
class Tax1099TransactionRequest extends Aggregate
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
     * Tax 1099 request.
     */
    public ?Tax1099Request $tax1099Request = null;

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
            'TAX1099RQ' => 'tax1099Request',
        ];
    }
}
