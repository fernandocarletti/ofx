<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-OID Form aggregate.
 *
 * Original issue discount (Form 1099-OID).
 */
class Tax1099Oid extends Aggregate
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
     * Box 1: Original issue discount.
     */
    public ?string $originalIssueDiscount = null;

    /**
     * Box 2: Other periodic interest.
     */
    public ?string $otherPeriodicInterest = null;

    /**
     * Box 3: Early withdrawal penalty.
     */
    public ?string $earlyWithdrawalPenalty = null;

    /**
     * Box 4: Federal income tax withheld.
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Box 5: Market discount.
     */
    public ?string $marketDiscount = null;

    /**
     * Box 6: Acquisition premium.
     */
    public ?string $acquisitionPremium = null;

    /**
     * Box 7: Description.
     */
    public ?string $description = null;

    /**
     * Box 8: Original issue discount on U.S. Treasury obligations.
     */
    public ?string $oidTreasury = null;

    /**
     * Box 9: Investment expenses.
     */
    public ?string $investmentExpenses = null;

    /**
     * Box 10: Bond premium.
     */
    public ?string $bondPremium = null;

    /**
     * Box 11: Tax-exempt OID.
     */
    public ?string $taxExemptOid = null;

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
            'ORIGISSDIS' => 'originalIssueDiscount',
            'OTHERPERINT' => 'otherPeriodicInterest',
            'ERLWTHPEN' => 'earlyWithdrawalPenalty',
            'FEDTAXWH' => 'federalTaxWithheld',
            'MARKETDISCOUNT' => 'marketDiscount',
            'ACQPREMIUM' => 'acquisitionPremium',
            'DESCRIPTION' => 'description',
            'OIDTREAS' => 'oidTreasury',
            'INVESTEXP' => 'investmentExpenses',
            'BONDPREMIUM' => 'bondPremium',
            'TAXEXEMPTOID' => 'taxExemptOid',
            'STATEINFO' => 'stateInfo',
            'ADDLSTATEINFO' => 'additionalStateInfo',
        ];
    }
}
