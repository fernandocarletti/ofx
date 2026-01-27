<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\BankAccount;
use Ofx\Model\Bank\Payee;

/**
 * Payment Info aggregate.
 *
 * Contains information about a payment.
 */
class PaymentInfo extends Aggregate
{
    /**
     * Bank account from which payment is made.
     */
    public ?BankAccount $bankAccountFrom = null;

    /**
     * Payee information.
     */
    public ?Payee $payee = null;

    /**
     * Extended payee information.
     */
    public ?ExtendedPayee $extendedPayee = null;

    /**
     * Payee ID assigned by the bill pay provider.
     */
    public ?string $payeeId = null;

    /**
     * Payee list ID.
     */
    public ?string $payeeListId = null;

    /**
     * Payee account number (your account number with the payee).
     */
    public ?string $payeeAccount = null;

    /**
     * Transfer amount (use bcmath for precision).
     */
    public ?string $transactionAmount = null;

    /**
     * Payment date.
     */
    public ?DateTimeImmutable $dueDate = null;

    /**
     * Memo to payee.
     */
    public ?string $memo = null;

    /**
     * Bill reference information.
     */
    public ?string $billReferenceInfo = null;

    /**
     * Bill publisher information.
     */
    public ?BillPublisherInfo $billPublisherInfo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BANKACCTFROM' => 'bankAccountFrom',
            'PAYEE' => 'payee',
            'EXTDPAYEE' => 'extendedPayee',
            'PAYEEID' => 'payeeId',
            'PAYEELSTID' => 'payeeListId',
            'PAYACCT' => 'payeeAccount',
            'TRNAMT' => 'transactionAmount',
            'DTDUE' => 'dueDate',
            'MEMO' => 'memo',
            'BILLREFINFO' => 'billReferenceInfo',
            'BILLPUBINFO' => 'billPublisherInfo',
        ];
    }
}
