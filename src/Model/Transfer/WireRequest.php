<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\BankAccount;

/**
 * Wire Transfer Request aggregate.
 *
 * Request to initiate a wire transfer.
 */
class WireRequest extends Aggregate
{
    /**
     * Source bank account.
     */
    public BankAccount $bankAccountFrom;

    /**
     * Destination bank information.
     */
    public WireDestBank $wireDestinationBank;

    /**
     * Beneficiary information.
     */
    public WireBeneficiary $wireBeneficiary;

    /**
     * Wire transfer amount (use bcmath for precision).
     */
    public string $transactionAmount;

    /**
     * Requested transfer date (optional).
     */
    public ?DateTimeImmutable $dueDate = null;

    /**
     * Payment instructions (optional).
     */
    public ?string $paymentInstructions = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BANKACCTFROM' => 'bankAccountFrom',
            'WIREDESTBANK' => 'wireDestinationBank',
            'WIREBENEFICIARY' => 'wireBeneficiary',
            'TRNAMT' => 'transactionAmount',
            'DTDUE' => 'dueDate',
            'PAYINSTRUCT' => 'paymentInstructions',
        ];
    }
}
