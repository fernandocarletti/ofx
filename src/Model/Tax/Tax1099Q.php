<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-Q Form aggregate.
 *
 * Payments from qualified education programs (Form 1099-Q).
 */
class Tax1099Q extends Aggregate
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
     * Box 2: Earnings.
     */
    public ?string $earnings = null;

    /**
     * Box 3: Basis.
     */
    public ?string $basis = null;

    /**
     * Box 4: Trustee-to-trustee transfer indicator (optional).
     */
    public ?bool $trusteeToTrusteeTransfer = null;

    /**
     * Box 5: Distribution type - private, state/local, designated beneficiary (optional).
     */
    public ?string $distributionType = null;

    /**
     * Box 6: Designated beneficiary under age 30 indicator (optional).
     */
    public ?bool $beneficiaryUnder30 = null;

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
            'EARNINGS' => 'earnings',
            'BASIS' => 'basis',
            'TRUSTEETOTRUST' => 'trusteeToTrusteeTransfer',
            'DISTTYPE' => 'distributionType',
            'BENEFUNDER30' => 'beneficiaryUnder30',
        ];
    }
}
