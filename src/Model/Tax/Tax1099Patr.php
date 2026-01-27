<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-PATR Form aggregate.
 *
 * Taxable distributions received from cooperatives (Form 1099-PATR).
 */
class Tax1099Patr extends Aggregate
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
     * Box 1: Patronage dividends.
     */
    public ?string $patronageDividends = null;

    /**
     * Box 2: Nonpatronage distributions.
     */
    public ?string $nonpatronageDistributions = null;

    /**
     * Box 3: Per-unit retain allocations.
     */
    public ?string $perUnitRetainAllocations = null;

    /**
     * Box 4: Federal income tax withheld.
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Box 5: Redemption of nonqualified notices and retain allocations.
     */
    public ?string $redemptionNonqualifiedNotices = null;

    /**
     * Box 6: Section 199A(g) deduction.
     */
    public ?string $section199aDeduction = null;

    /**
     * Box 7: Qualified payments.
     */
    public ?string $qualifiedPayments = null;

    /**
     * Box 8: Section 199A(a) qualified items (optional).
     */
    public ?string $section199aQualifiedItems = null;

    /**
     * Box 9: Section 199A(a) SSTB items (optional).
     */
    public ?string $section199aSstbItems = null;

    /**
     * Box 10: Investment credit.
     */
    public ?string $investmentCredit = null;

    /**
     * Box 11: Work opportunity credit.
     */
    public ?string $workOpportunityCredit = null;

    /**
     * Box 12: Other credits and deductions.
     */
    public ?string $otherCredits = null;

    /**
     * Specified agricultural or horticultural cooperative indicator (optional).
     */
    public ?bool $specifiedAgricultureCooperative = null;

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
            'PATDIV' => 'patronageDividends',
            'NONPATDIST' => 'nonpatronageDistributions',
            'PERUNITRETAIN' => 'perUnitRetainAllocations',
            'FEDTAXWH' => 'federalTaxWithheld',
            'REDNONQNOT' => 'redemptionNonqualifiedNotices',
            'SEC199ADEDUCTION' => 'section199aDeduction',
            'QUALPMTS' => 'qualifiedPayments',
            'SEC199AQUALITEMS' => 'section199aQualifiedItems',
            'SEC199ASSTBITEMS' => 'section199aSstbItems',
            'INVESTCR' => 'investmentCredit',
            'WORKOPCR' => 'workOpportunityCredit',
            'OTHERCR' => 'otherCredits',
            'SPECAGCOOPYN' => 'specifiedAgricultureCooperative',
        ];
    }
}
