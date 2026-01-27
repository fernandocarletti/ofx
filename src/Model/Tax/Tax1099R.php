<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-R Form aggregate.
 *
 * Distributions from pensions, annuities, retirement, IRAs, etc. (Form 1099-R).
 */
class Tax1099R extends Aggregate
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
     * Box 1: Gross distribution.
     */
    public ?string $grossDistribution = null;

    /**
     * Box 2a: Taxable amount.
     */
    public ?string $taxableAmount = null;

    /**
     * Box 2b: Taxable amount not determined (optional).
     */
    public ?bool $taxableAmountNotDetermined = null;

    /**
     * Box 2b: Total distribution (optional).
     */
    public ?bool $totalDistribution = null;

    /**
     * Box 3: Capital gain.
     */
    public ?string $capitalGain = null;

    /**
     * Box 4: Federal income tax withheld.
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Box 5: Employee contributions/designated Roth contributions or insurance premiums.
     */
    public ?string $employeeContributionsInsurance = null;

    /**
     * Box 6: Net unrealized appreciation in employer's securities.
     */
    public ?string $netUnrealizedAppreciationSecurities = null;

    /**
     * Box 7: Distribution code(s).
     */
    public ?string $distributionCode = null;

    /**
     * Box 7: IRA/SEP/SIMPLE indicator (optional).
     */
    public ?bool $iraSepSimple = null;

    /**
     * Box 8: Other amount.
     */
    public ?string $other = null;

    /**
     * Box 8: Other percentage (optional).
     */
    public ?string $otherPercentage = null;

    /**
     * Box 9a: Your percentage of total distribution (optional).
     */
    public ?string $totalEmployeeContributions = null;

    /**
     * Box 9b: Total employee contributions.
     */
    public ?string $totalDistributionCurrentValue = null;

    /**
     * Box 10: Amount allocable to IRR within 5 years (optional).
     */
    public ?string $amountAllocableIrrWithin5Years = null;

    /**
     * Box 11: 1st year of designated Roth contribution (optional).
     */
    public ?string $firstYearRothDistribution = null;

    /**
     * Box 14: State tax withheld.
     */
    public ?string $stateTaxWithheld = null;

    /**
     * Box 15: State/Payer's state no.
     */
    public ?string $stateIdNumber = null;

    /**
     * Box 16: State distribution.
     */
    public ?string $stateDistribution = null;

    /**
     * Box 17: Local tax withheld (optional).
     */
    public ?string $localTaxWithheld = null;

    /**
     * Box 18: Name of locality (optional).
     */
    public ?string $localityName = null;

    /**
     * Box 19: Local distribution (optional).
     */
    public ?string $localDistribution = null;

    /**
     * State tax information (optional).
     */
    public ?StateInfo $stateInfo = null;

    /**
     * Local tax information (optional).
     */
    public ?LocalInfo $localInfo = null;

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
            'GROSSDIST' => 'grossDistribution',
            'TAXAMT' => 'taxableAmount',
            'TAXAMTND' => 'taxableAmountNotDetermined',
            'TOTALDIST' => 'totalDistribution',
            'CAPGAIN' => 'capitalGain',
            'FEDTAXWH' => 'federalTaxWithheld',
            'EMPCONTINS' => 'employeeContributionsInsurance',
            'NETUNAPPSEC' => 'netUnrealizedAppreciationSecurities',
            'DISTCODE' => 'distributionCode',
            'IRASEP' => 'iraSepSimple',
            'OTHER' => 'other',
            'OTHERPCT' => 'otherPercentage',
            'TOTEMPCONTRIB' => 'totalEmployeeContributions',
            'TOTLDISTCV' => 'totalDistributionCurrentValue',
            'AMTALLOCIRRWITHIN5' => 'amountAllocableIrrWithin5Years',
            'YR1STROTHDIST' => 'firstYearRothDistribution',
            'STATETAXWH' => 'stateTaxWithheld',
            'STATEIDNUM' => 'stateIdNumber',
            'STATEDISTR' => 'stateDistribution',
            'LOCALTAXWH' => 'localTaxWithheld',
            'LOCALNAME' => 'localityName',
            'LOCALDISTR' => 'localDistribution',
            'STATEINFO' => 'stateInfo',
            'LOCALINFO' => 'localInfo',
        ];
    }
}
