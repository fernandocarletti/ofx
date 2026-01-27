<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-S Form aggregate.
 *
 * Proceeds from real estate transactions (Form 1099-S).
 */
class Tax1099S extends Aggregate
{
    /**
     * Server ID for this 1099 form.
     */
    public string $serverTransactionId;

    /**
     * Tax year.
     */
    public string $taxYear;

    /**
     * Void indicator (optional).
     */
    public ?bool $void = null;

    /**
     * Corrected indicator (optional).
     */
    public ?bool $corrected = null;

    /**
     * Payer address (filer/settlement agent).
     */
    public ?PayerAddress $payerAddress = null;

    /**
     * Payer ID (EIN).
     */
    public ?string $payerId = null;

    /**
     * Recipient address (transferor).
     */
    public ?RecipientAddress $recipientAddress = null;

    /**
     * Recipient ID (SSN/TIN).
     */
    public ?string $recipientId = null;

    /**
     * Recipient account number (optional).
     */
    public ?string $recipientAccount = null;

    /**
     * Box 1: Date of closing.
     */
    public ?DateTimeImmutable $dateOfClosing = null;

    /**
     * Box 2: Gross proceeds.
     */
    public ?string $grossProceeds = null;

    /**
     * Box 3: Address or legal description of property.
     */
    public ?string $propertyDescription = null;

    /**
     * Box 4: Transferor received or will receive property or services (optional).
     */
    public ?bool $receivedPropertyServices = null;

    /**
     * Box 5: Buyer's part of real estate tax.
     */
    public ?string $buyerRealEstateTax = null;

    /**
     * Box 6: Real estate tax prorated (optional).
     */
    public ?bool $taxProrated = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'TAXYEAR' => 'taxYear',
            'VOID' => 'void',
            'CORRECTED' => 'corrected',
            'PAYERADDR' => 'payerAddress',
            'PAYERID' => 'payerId',
            'RECADDR' => 'recipientAddress',
            'RECID' => 'recipientId',
            'RECACCT' => 'recipientAccount',
            'DTCLOSING' => 'dateOfClosing',
            'GROSSPROCEEDS' => 'grossProceeds',
            'PROPDESCRIPTION' => 'propertyDescription',
            'RECEIVEDPROPSVCS' => 'receivedPropertyServices',
            'BUYERREALESTATETAX' => 'buyerRealEstateTax',
            'TAXPRORATEDYN' => 'taxProrated',
        ];
    }
}
