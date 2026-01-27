<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-G Form aggregate.
 *
 * Certain government payments (Form 1099-G).
 */
class Tax1099G extends Aggregate
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
     * Box 1: Unemployment compensation.
     */
    public ?string $unemploymentCompensation = null;

    /**
     * Box 2: State or local income tax refunds, credits, or offsets.
     */
    public ?string $stateLocalTaxRefund = null;

    /**
     * Box 3: Box 2 amount is for tax year (optional).
     */
    public ?string $box2TaxYear = null;

    /**
     * Box 4: Federal income tax withheld.
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Box 5: RTAA payments.
     */
    public ?string $rtaaPayments = null;

    /**
     * Box 6: Taxable grants.
     */
    public ?string $taxableGrants = null;

    /**
     * Box 7: Agriculture payments.
     */
    public ?string $agriculturePayments = null;

    /**
     * Box 8: Check if box 2 is trade or business income (optional).
     */
    public ?bool $tradeOrBusiness = null;

    /**
     * Box 9: Market gain.
     */
    public ?string $marketGain = null;

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
            'UNEMPLCOMP' => 'unemploymentCompensation',
            'STLOCTAXREF' => 'stateLocalTaxRefund',
            'BOX2YEAR' => 'box2TaxYear',
            'FEDTAXWH' => 'federalTaxWithheld',
            'RTAAPAY' => 'rtaaPayments',
            'TXBLGRANTS' => 'taxableGrants',
            'AGRIPAY' => 'agriculturePayments',
            'TRADEBUSINESS' => 'tradeOrBusiness',
            'MARKETGAIN' => 'marketGain',
            'STATEINFO' => 'stateInfo',
            'ADDLSTATEINFO' => 'additionalStateInfo',
        ];
    }
}
