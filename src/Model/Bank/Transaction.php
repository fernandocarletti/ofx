<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\TransactionType;
use Ofx\Model\Common\Currency;
use Ofx\Model\Common\OrigCurrency;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Bank Transaction aggregate (STMTTRN).
 *
 * Contains a single bank or credit card transaction.
 */
class Transaction extends Aggregate
{
    /**
     * Transaction type.
     */
    public TransactionType $type;

    /**
     * Date transaction was posted to account.
     */
    public DateTimeImmutable $datePosted;

    /**
     * Date user initiated transaction (optional).
     */
    public ?DateTimeImmutable $dateInitiated = null;

    /**
     * Date funds are available (optional).
     */
    public ?DateTimeImmutable $dateAvailable = null;

    /**
     * Transaction amount.
     *
     * @phpstan-var numeric-string
     */
    public string $amount;

    /**
     * Financial institution's transaction ID.
     */
    public string $transactionId;

    /**
     * ID of transaction being corrected (optional).
     */
    public ?string $correctedTransactionId = null;

    /**
     * Correction action: DELETE or REPLACE (optional).
     */
    public ?string $correctionAction = null;

    /**
     * Server-assigned transaction ID (optional).
     */
    public ?string $serverTransactionId = null;

    /**
     * Check number (optional).
     */
    public ?string $checkNumber = null;

    /**
     * Reference number (optional).
     */
    public ?string $referenceNumber = null;

    /**
     * Standard Industrial Code (optional).
     */
    public ?string $sic = null;

    /**
     * Payee identifier (optional).
     */
    public ?string $payeeId = null;

    /**
     * Payee name (optional).
     */
    public ?string $name = null;

    /**
     * Payee information (optional).
     */
    public ?Payee $payee = null;

    /**
     * Destination bank account for transfers (optional).
     */
    public ?BankAccount $bankAccountTo = null;

    /**
     * Destination credit card account for transfers (optional).
     */
    public ?CreditCardAccount $creditCardAccountTo = null;

    /**
     * Transaction memo (optional).
     */
    public ?string $memo = null;

    /**
     * Currency information (optional).
     */
    public ?Currency $currency = null;

    /**
     * Original currency for international transactions (optional).
     */
    public ?OrigCurrency $originalCurrency = null;

    /**
     * Check if transaction is a credit.
     *
     * @return bool True if credit
     */
    public function isCredit(): bool
    {
        return bccomp($this->amount, '0', 2) > 0;
    }

    /**
     * Check if transaction is a debit.
     *
     * @return bool True if debit
     */
    public function isDebit(): bool
    {
        return bccomp($this->amount, '0', 2) < 0;
    }

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'TRNTYPE' => 'type',
            'DTPOSTED' => 'datePosted',
            'DTUSER' => 'dateInitiated',
            'DTAVAIL' => 'dateAvailable',
            'TRNAMT' => 'amount',
            'FITID' => 'transactionId',
            'CORRECTFITID' => 'correctedTransactionId',
            'CORRECTACTION' => 'correctionAction',
            'SRVRTID' => 'serverTransactionId',
            'CHECKNUM' => 'checkNumber',
            'REFNUM' => 'referenceNumber',
            'SIC' => 'sic',
            'PAYEEID' => 'payeeId',
            'NAME' => 'name',
            'PAYEE' => 'payee',
            'BANKACCTTO' => 'bankAccountTo',
            'CCACCTTO' => 'creditCardAccountTo',
            'MEMO' => 'memo',
            'CURRENCY' => 'currency',
            'ORIGCURRENCY' => 'originalCurrency',
        ];
    }

    /**
     * Parse property value with special handling for enum.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        $tagName = $child->getName();

        if ($tagName === 'TRNTYPE') {
            return TransactionType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
