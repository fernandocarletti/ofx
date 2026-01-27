<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-C Form aggregate.
 *
 * Cancellation of debt (Form 1099-C).
 */
class Tax1099C extends Aggregate
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
     * Payer address.
     */
    public ?PayerAddress $payerAddress = null;

    /**
     * Payer ID (EIN).
     */
    public ?string $payerId = null;

    /**
     * Recipient address.
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
     * Box 1: Date of identifiable event.
     */
    public ?DateTimeImmutable $identifiableEventDate = null;

    /**
     * Box 2: Amount of debt discharged.
     */
    public ?string $debtDischarged = null;

    /**
     * Box 3: Interest if included in box 2.
     */
    public ?string $interestIncluded = null;

    /**
     * Box 4: Debt description.
     */
    public ?string $debtDescription = null;

    /**
     * Box 5: Check if the debtor was personally liable (optional).
     */
    public ?bool $personallyLiable = null;

    /**
     * Box 6: Identifiable event code.
     */
    public ?string $identifiableEventCode = null;

    /**
     * Box 7: Fair market value of property.
     */
    public ?string $fairMarketValueProperty = null;

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
            'IDENTEVENT' => 'identifiableEventDate',
            'DEBTDISCHG' => 'debtDischarged',
            'INTINCLUDED' => 'interestIncluded',
            'DEBTDESC' => 'debtDescription',
            'PERSLIABLE' => 'personallyLiable',
            'IDENTEVENTCODE' => 'identifiableEventCode',
            'FMVPROP' => 'fairMarketValueProperty',
        ];
    }
}
