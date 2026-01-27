<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-SA Form aggregate.
 *
 * Distributions from an HSA, Archer MSA, or Medicare Advantage MSA (Form 1099-SA).
 */
class Tax1099Sa extends Aggregate
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
     * Box 2: Earnings on excess contributions.
     */
    public ?string $earningsExcessContributions = null;

    /**
     * Box 3: Distribution code.
     */
    public ?string $distributionCode = null;

    /**
     * Box 4: Fair market value of account on date of death.
     */
    public ?string $fairMarketValueDateOfDeath = null;

    /**
     * Box 5: HSA, Archer MSA, or MA MSA type indicator.
     */
    public ?string $accountType = null;

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
            'EARNEXCESSCONT' => 'earningsExcessContributions',
            'DISTCODE' => 'distributionCode',
            'FMVDOD' => 'fairMarketValueDateOfDeath',
            'ACCTTYPE' => 'accountType',
        ];
    }
}
