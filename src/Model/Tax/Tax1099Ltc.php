<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-LTC Form aggregate.
 *
 * Long-term care and accelerated death benefits (Form 1099-LTC).
 */
class Tax1099Ltc extends Aggregate
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
     * Policyholder name (optional).
     */
    public ?string $policyholderName = null;

    /**
     * Policyholder TIN (optional).
     */
    public ?string $policyholderTin = null;

    /**
     * Box 1: Gross long-term care benefits paid.
     */
    public ?string $grossLongTermCareBenefits = null;

    /**
     * Box 2: Accelerated death benefits paid.
     */
    public ?string $acceleratedDeathBenefits = null;

    /**
     * Box 3: Per diem or reimbursed indicator.
     */
    public ?string $perDiem = null;

    /**
     * Insured name (optional).
     */
    public ?string $insuredName = null;

    /**
     * Insured address (optional).
     */
    public ?RecipientAddress $insuredAddress = null;

    /**
     * Date certified chronically ill (optional).
     */
    public ?DateTimeImmutable $dateCertifiedChronicallyIll = null;

    /**
     * Qualified contract indicator (optional).
     */
    public ?bool $qualifiedContract = null;

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
            'POLICYHOLDR' => 'policyholderName',
            'POLICYHOLDRTIN' => 'policyholderTin',
            'GROLTCBEN' => 'grossLongTermCareBenefits',
            'ACCELDTHBEN' => 'acceleratedDeathBenefits',
            'PERDIEM' => 'perDiem',
            'INSUREDNAME' => 'insuredName',
            'INSUREDADDR' => 'insuredAddress',
            'DTCERTCHRONICILL' => 'dateCertifiedChronicallyIll',
            'QUALCONTRACT' => 'qualifiedContract',
        ];
    }
}
