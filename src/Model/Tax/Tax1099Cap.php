<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-CAP Form aggregate.
 *
 * Changes in corporate control and capital structure (Form 1099-CAP).
 */
class Tax1099Cap extends Aggregate
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
     * Box 1: Date of sale or exchange.
     */
    public ?DateTimeImmutable $dateSaleExchange = null;

    /**
     * Box 2: Aggregate amount received.
     */
    public ?string $aggregateAmountReceived = null;

    /**
     * Box 3: Number of shares exchanged.
     */
    public ?string $numberOfShares = null;

    /**
     * Box 4: Classes of stock exchanged.
     */
    public ?string $classesOfStock = null;

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
            'DTSALEEXCH' => 'dateSaleExchange',
            'AGGAMT' => 'aggregateAmountReceived',
            'NUMSHRS' => 'numberOfShares',
            'CLASSSTOCK' => 'classesOfStock',
        ];
    }
}
