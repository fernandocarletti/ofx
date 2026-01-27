<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-DIV Form aggregate.
 *
 * Dividends and distributions (Form 1099-DIV).
 */
class Tax1099Div extends Aggregate
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
     * Box 1a: Total ordinary dividends.
     */
    public ?string $ordinaryDividends = null;

    /**
     * Box 1b: Qualified dividends.
     */
    public ?string $qualifiedDividends = null;

    /**
     * Box 2a: Total capital gain distributions.
     */
    public ?string $totalCapitalGain = null;

    /**
     * Box 2b: Unrecaptured Section 1250 gain.
     */
    public ?string $unrecapturedSection1250 = null;

    /**
     * Box 2c: Section 1202 gain.
     */
    public ?string $section1202 = null;

    /**
     * Box 2d: Collectibles (28%) gain.
     */
    public ?string $collectibles = null;

    /**
     * Box 2e: Section 897 ordinary dividends (optional).
     */
    public ?string $section897OrdinaryDividends = null;

    /**
     * Box 2f: Section 897 capital gain (optional).
     */
    public ?string $section897CapitalGain = null;

    /**
     * Box 3: Nondividend distributions.
     */
    public ?string $nondividendDistributions = null;

    /**
     * Box 4: Federal income tax withheld.
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Box 5: Section 199A dividends (optional).
     */
    public ?string $section199a = null;

    /**
     * Box 6: Investment expenses.
     */
    public ?string $investmentExpenses = null;

    /**
     * Box 7: Foreign tax paid.
     */
    public ?string $foreignTaxPaid = null;

    /**
     * Box 8: Foreign country or U.S. possession.
     */
    public ?string $foreignCountry = null;

    /**
     * Box 9: Cash liquidation distributions.
     */
    public ?string $cashLiquidation = null;

    /**
     * Box 10: Noncash liquidation distributions.
     */
    public ?string $noncashLiquidation = null;

    /**
     * Box 11: FATCA filing requirement (optional).
     */
    public ?bool $fatcaRequired = null;

    /**
     * Box 12: Exempt-interest dividends.
     */
    public ?string $exemptInterestDividends = null;

    /**
     * Box 13: Specified private activity bond interest dividends.
     */
    public ?string $specifiedPrivateBondInterest = null;

    /**
     * State tax information (optional).
     */
    public ?StateInfo $stateInfo = null;

    /**
     * Additional state information (optional).
     */
    public ?AddlStateTaxWhAgg $additionalStateInfo = null;

    /**
     * Foreign account tax compliance information (optional).
     */
    public ?ForeignAccountTaxComp $foreignAccountCompliance = null;

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
            'ORDDIV' => 'ordinaryDividends',
            'QUALIFIEDDIV' => 'qualifiedDividends',
            'TOTCAPGAIN' => 'totalCapitalGain',
            'UNRECSEC1250' => 'unrecapturedSection1250',
            'SEC1202' => 'section1202',
            'COLLECTIBLES' => 'collectibles',
            'SEC897ORDDIV' => 'section897OrdinaryDividends',
            'SEC897CAPGAIN' => 'section897CapitalGain',
            'NONDIVDIST' => 'nondividendDistributions',
            'FEDTAXWH' => 'federalTaxWithheld',
            'SEC199A' => 'section199a',
            'INVESTEXP' => 'investmentExpenses',
            'FOREIGNTAXPD' => 'foreignTaxPaid',
            'FOREIGNCNTRY' => 'foreignCountry',
            'CASHLIQ' => 'cashLiquidation',
            'NONCASHLIQ' => 'noncashLiquidation',
            'FATCAREQUIRED' => 'fatcaRequired',
            'EXEMPTINTDIV' => 'exemptInterestDividends',
            'SPECPRIVATEBONDINT' => 'specifiedPrivateBondInterest',
            'STATEINFO' => 'stateInfo',
            'ADDLSTATEINFO' => 'additionalStateInfo',
            'FOREIGNACCTCOMP' => 'foreignAccountCompliance',
        ];
    }
}
