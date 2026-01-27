<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Model;

use DateTimeImmutable;
use Ofx\Enum\TransactionType;
use Ofx\Model\Bank\Transaction;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Unit tests for Transaction model.
 *
 * Tests the isCredit() and isDebit() methods which use bccomp
 * to compare the transaction amount to zero.
 */
final class TransactionTest extends TestCase
{
    #[Test]
    public function isCreditReturnsTrueForPositiveAmount(): void
    {
        $transaction = $this->createTransaction('100.00');

        self::assertTrue($transaction->isCredit());
        self::assertFalse($transaction->isDebit());
    }

    #[Test]
    public function isDebitReturnsTrueForNegativeAmount(): void
    {
        $transaction = $this->createTransaction('-100.00');

        self::assertFalse($transaction->isCredit());
        self::assertTrue($transaction->isDebit());
    }

    #[Test]
    public function isNeitherCreditNorDebitForZero(): void
    {
        $transaction = $this->createTransaction('0.00');

        self::assertFalse($transaction->isCredit());
        self::assertFalse($transaction->isDebit());
    }

    #[Test]
    public function isCreditHandlesSmallPositiveAmount(): void
    {
        $transaction = $this->createTransaction('0.01');

        self::assertTrue($transaction->isCredit());
        self::assertFalse($transaction->isDebit());
    }

    #[Test]
    public function isDebitHandlesSmallNegativeAmount(): void
    {
        $transaction = $this->createTransaction('-0.01');

        self::assertFalse($transaction->isCredit());
        self::assertTrue($transaction->isDebit());
    }

    #[Test]
    public function isCreditHandlesLargePositiveAmount(): void
    {
        $transaction = $this->createTransaction('999999999.99');

        self::assertTrue($transaction->isCredit());
        self::assertFalse($transaction->isDebit());
    }

    #[Test]
    public function isDebitHandlesLargeNegativeAmount(): void
    {
        $transaction = $this->createTransaction('-999999999.99');

        self::assertFalse($transaction->isCredit());
        self::assertTrue($transaction->isDebit());
    }

    #[Test]
    #[DataProvider('creditAmountsProvider')]
    public function isCreditForVariousPositiveAmounts(string $amount): void
    {
        $transaction = $this->createTransaction($amount);

        self::assertTrue($transaction->isCredit());
    }

    /**
     * @return array<string, array{string}>
     */
    public static function creditAmountsProvider(): array
    {
        return [
            'integer' => ['100'],
            'decimal' => ['100.50'],
            'large' => ['1000000.00'],
            'explicit positive' => ['+50.00'],
        ];
    }

    #[Test]
    #[DataProvider('debitAmountsProvider')]
    public function isDebitForVariousNegativeAmounts(string $amount): void
    {
        $transaction = $this->createTransaction($amount);

        self::assertTrue($transaction->isDebit());
    }

    /**
     * @return array<string, array{string}>
     */
    public static function debitAmountsProvider(): array
    {
        return [
            'integer' => ['-100'],
            'decimal' => ['-100.50'],
            'large' => ['-1000000.00'],
        ];
    }

    #[Test]
    #[DataProvider('zeroAmountsProvider')]
    public function neitherCreditNorDebitForZeroVariations(string $amount): void
    {
        $transaction = $this->createTransaction($amount);

        self::assertFalse($transaction->isCredit());
        self::assertFalse($transaction->isDebit());
    }

    /**
     * @return array<string, array{string}>
     */
    public static function zeroAmountsProvider(): array
    {
        return [
            'zero' => ['0'],
            'zero decimal' => ['0.00'],
            'zero with many decimals' => ['0.000000'],
        ];
    }

    /**
     * Create a Transaction with the given amount.
     *
     * Uses reflection to set the required properties without going through parsing.
     */
    private function createTransaction(string $amount): Transaction
    {
        $transaction = new Transaction();

        // Use reflection to set required properties
        $reflection = new ReflectionClass($transaction);

        $amountProp = $reflection->getProperty('amount');
        $amountProp->setValue($transaction, $amount);

        $typeProp = $reflection->getProperty('type');
        $typeProp->setValue($transaction, TransactionType::OTHER);

        $transactionIdProp = $reflection->getProperty('transactionId');
        $transactionIdProp->setValue($transaction, 'TEST123');

        $datePostedProp = $reflection->getProperty('datePosted');
        $datePostedProp->setValue($transaction, new DateTimeImmutable());

        return $transaction;
    }
}
