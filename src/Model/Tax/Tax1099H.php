<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-H Form aggregate.
 *
 * Health coverage tax credit (HCTC) advance payments (Form 1099-H).
 */
class Tax1099H extends Aggregate
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
     * Box 1: Amount of HCTC advance payments.
     */
    public ?string $hctcAdvancePayments = null;

    /**
     * Box 2: Number of months HCTC advance payments (optional).
     */
    public ?int $hctcMonths = null;

    /**
     * Box 3: January reimbursement (optional).
     */
    public ?string $januaryReimbursement = null;

    /**
     * Box 4: February reimbursement (optional).
     */
    public ?string $februaryReimbursement = null;

    /**
     * Box 5: March reimbursement (optional).
     */
    public ?string $marchReimbursement = null;

    /**
     * Box 6: April reimbursement (optional).
     */
    public ?string $aprilReimbursement = null;

    /**
     * Box 7: May reimbursement (optional).
     */
    public ?string $mayReimbursement = null;

    /**
     * Box 8: June reimbursement (optional).
     */
    public ?string $juneReimbursement = null;

    /**
     * Box 9: July reimbursement (optional).
     */
    public ?string $julyReimbursement = null;

    /**
     * Box 10: August reimbursement (optional).
     */
    public ?string $augustReimbursement = null;

    /**
     * Box 11: September reimbursement (optional).
     */
    public ?string $septemberReimbursement = null;

    /**
     * Box 12: October reimbursement (optional).
     */
    public ?string $octoberReimbursement = null;

    /**
     * Box 13: November reimbursement (optional).
     */
    public ?string $novemberReimbursement = null;

    /**
     * Box 14: December reimbursement (optional).
     */
    public ?string $decemberReimbursement = null;

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
            'HCTCADVPMT' => 'hctcAdvancePayments',
            'HCTCMONTHS' => 'hctcMonths',
            'JANREIMBMT' => 'januaryReimbursement',
            'FEBREIMBMT' => 'februaryReimbursement',
            'MARREIMBMT' => 'marchReimbursement',
            'APRREIMBMT' => 'aprilReimbursement',
            'MAYREIMBMT' => 'mayReimbursement',
            'JUNREIMBMT' => 'juneReimbursement',
            'JULREIMBMT' => 'julyReimbursement',
            'AUGREIMBMT' => 'augustReimbursement',
            'SEPREIMBMT' => 'septemberReimbursement',
            'OCTREIMBMT' => 'octoberReimbursement',
            'NOVREIMBMT' => 'novemberReimbursement',
            'DECREIMBMT' => 'decemberReimbursement',
        ];
    }
}
