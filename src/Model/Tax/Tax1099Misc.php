<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-MISC Form aggregate.
 *
 * Miscellaneous income (Form 1099-MISC).
 */
class Tax1099Misc extends Aggregate
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
     * Box 1: Rents.
     */
    public ?string $rents = null;

    /**
     * Box 2: Royalties.
     */
    public ?string $royalties = null;

    /**
     * Box 3: Other income.
     */
    public ?string $otherIncome = null;

    /**
     * Box 4: Federal income tax withheld.
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Box 5: Fishing boat proceeds.
     */
    public ?string $fishingBoatProceeds = null;

    /**
     * Box 6: Medical and health care payments.
     */
    public ?string $medicalHealthPayments = null;

    /**
     * Box 7: Payer made direct sales of $5,000 or more (optional).
     */
    public ?bool $directSales = null;

    /**
     * Box 8: Substitute payments in lieu of dividends or interest.
     */
    public ?string $substitutePayments = null;

    /**
     * Box 9: Crop insurance proceeds.
     */
    public ?string $cropInsuranceProceeds = null;

    /**
     * Box 10: Gross proceeds paid to an attorney.
     */
    public ?string $grossProceedsAttorney = null;

    /**
     * Box 11: Fish purchased for resale.
     */
    public ?string $fishPurchasedResale = null;

    /**
     * Box 12: Section 409A deferrals.
     */
    public ?string $section409aDeferrals = null;

    /**
     * Box 13: FATCA filing requirement (optional).
     */
    public ?bool $fatcaRequired = null;

    /**
     * Box 14: Excess golden parachute payments.
     */
    public ?string $goldenParachute = null;

    /**
     * Box 15: Nonqualified deferred compensation.
     */
    public ?string $nonqualifiedDeferredCompensation = null;

    /**
     * State tax information (optional).
     */
    public ?StateInfo $stateInfo = null;

    /**
     * Additional state information (optional).
     */
    public ?AddlStateTaxWhAgg $additionalStateInfo = null;

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
            'RENTS' => 'rents',
            'ROYALTIES' => 'royalties',
            'OTHERINCOME' => 'otherIncome',
            'FEDTAXWH' => 'federalTaxWithheld',
            'FISHBOATPROC' => 'fishingBoatProceeds',
            'MEDHEALTHPAY' => 'medicalHealthPayments',
            'DIRECTSALES' => 'directSales',
            'SUBPMTS' => 'substitutePayments',
            'CROPINSPROC' => 'cropInsuranceProceeds',
            'GROSSPROCATTORNEY' => 'grossProceedsAttorney',
            'FISHPURCHRESALE' => 'fishPurchasedResale',
            'SEC409ADEF' => 'section409aDeferrals',
            'FATCAREQUIRED' => 'fatcaRequired',
            'GOLDENPARA' => 'goldenParachute',
            'NONQUALDEFCOMP' => 'nonqualifiedDeferredCompensation',
            'STATEINFO' => 'stateInfo',
            'ADDLSTATEINFO' => 'additionalStateInfo',
        ];
    }
}
