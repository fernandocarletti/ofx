<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\BankAccount;

/**
 * Transfer Info aggregate.
 *
 * Contains transfer details including source/destination accounts and amount.
 */
class TransferInfo extends Aggregate
{
    /**
     * Source bank account.
     */
    public BankAccount $bankAccountFrom;

    /**
     * Destination bank account.
     */
    public BankAccount $bankAccountTo;

    /**
     * Transfer amount (use bcmath for precision).
     */
    public string $transactionAmount;

    /**
     * Requested transfer date (optional).
     */
    public ?DateTimeImmutable $dueDate = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BANKACCTFROM' => 'bankAccountFrom',
            'BANKACCTTO' => 'bankAccountTo',
            'TRNAMT' => 'transactionAmount',
            'DTDUE' => 'dueDate',
        ];
    }
}
