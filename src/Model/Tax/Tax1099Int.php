<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-INT Form aggregate.
 *
 * Interest income (Form 1099-INT).
 */
class Tax1099Int extends Aggregate
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
     * Box 1: Interest income.
     */
    public ?string $interestIncome = null;

    /**
     * Box 2: Early withdrawal penalty.
     */
    public ?string $earlyWithdrawalPenalty = null;

    /**
     * Box 3: Interest on U.S. Savings Bonds and Treasury obligations.
     */
    public ?string $interestUsBondsTreasury = null;

    /**
     * Box 4: Federal income tax withheld.
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Box 5: Investment expenses.
     */
    public ?string $investmentExpenses = null;

    /**
     * Box 6: Foreign tax paid.
     */
    public ?string $foreignTaxPaid = null;

    /**
     * Box 7: Foreign country or U.S. possession.
     */
    public ?string $foreignCountry = null;

    /**
     * Box 8: Tax-exempt interest.
     */
    public ?string $taxExemptInterest = null;

    /**
     * Box 9: Specified private activity bond interest.
     */
    public ?string $specifiedPrivateBonds = null;

    /**
     * Box 10: Market discount.
     */
    public ?string $marketDiscount = null;

    /**
     * Box 11: Bond premium.
     */
    public ?string $bondPremium = null;

    /**
     * Box 12: Bond premium on Treasury obligations (optional).
     */
    public ?string $bondPremiumTreasury = null;

    /**
     * Box 13: Bond premium on tax-exempt bond (optional).
     */
    public ?string $bondPremiumTaxExempt = null;

    /**
     * FATCA filing requirement (optional).
     */
    public ?bool $fatcaRequired = null;

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
            'INTINCOME' => 'interestIncome',
            'ERLWTHPEN' => 'earlyWithdrawalPenalty',
            'INTUSBNDTRS' => 'interestUsBondsTreasury',
            'FEDTAXWH' => 'federalTaxWithheld',
            'INVESTEXP' => 'investmentExpenses',
            'FOREIGNTAXPD' => 'foreignTaxPaid',
            'FOREIGNCNTRY' => 'foreignCountry',
            'TAXEXEMPTINT' => 'taxExemptInterest',
            'SPECPRIVBNDS' => 'specifiedPrivateBonds',
            'MARKETDISCOUNT' => 'marketDiscount',
            'BONDPREMIUM' => 'bondPremium',
            'BONDPREMTREAS' => 'bondPremiumTreasury',
            'BONDPREMTAXEXEMPT' => 'bondPremiumTaxExempt',
            'FATCAREQUIRED' => 'fatcaRequired',
            'STATEINFO' => 'stateInfo',
            'ADDLSTATEINFO' => 'additionalStateInfo',
        ];
    }
}
