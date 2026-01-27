<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\BankAccount;

/**
 * Wire Transfer Response aggregate.
 *
 * Response to a wire transfer request.
 */
class WireResponse extends Aggregate
{
    /**
     * Server-assigned reference number.
     */
    public ?string $referenceServerTransactionId = null;

    /**
     * Server-assigned transaction ID.
     */
    public string $serverTransactionId;

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
     * Requested transfer date.
     */
    public ?DateTimeImmutable $dueDate = null;

    /**
     * Payment instructions.
     */
    public ?string $paymentInstructions = null;

    /**
     * Expected posting date.
     */
    public ?DateTimeImmutable $projectedTransferDate = null;

    /**
     * Actual posting date.
     */
    public ?DateTimeImmutable $postedDate = null;

    /**
     * Confirmation message.
     */
    public ?string $confirmationMessage = null;

    /**
     * Wire fee charged (use bcmath for precision).
     */
    public ?string $fee = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'REFSRVRTID' => 'referenceServerTransactionId',
            'SRVRTID' => 'serverTransactionId',
            'BANKACCTFROM' => 'bankAccountFrom',
            'WIREDESTBANK' => 'wireDestinationBank',
            'WIREBENEFICIARY' => 'wireBeneficiary',
            'TRNAMT' => 'transactionAmount',
            'DTDUE' => 'dueDate',
            'PAYINSTRUCT' => 'paymentInstructions',
            'DTXFERPRJ' => 'projectedTransferDate',
            'DTPOSTED' => 'postedDate',
            'CONFIRMATIONMSG' => 'confirmationMessage',
            'FEE' => 'fee',
        ];
    }
}
