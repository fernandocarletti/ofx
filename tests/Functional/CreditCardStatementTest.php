<?php

declare(strict_types=1);

namespace Ofx\Tests\Functional;

use Ofx\Enum\Severity;
use Ofx\Enum\TransactionType;
use PHPUnit\Framework\Attributes\Test;

/**
 * Functional tests for credit card statement parsing.
 *
 * Tests credit card specific OFX structures including:
 * - Credit card account information
 * - Transaction list
 * - Balance information
 */
final class CreditCardStatementTest extends FunctionalTestCase
{
    #[Test]
    public function parseBasicCreditCardStatement(): void
    {
        $ofx = $this->parseFixture('/CreditCard/statement_basic.ofx');

        // Verify signon response
        $signonMessages = $ofx->signonMessagesResponseV1;
        self::assertNotNull($signonMessages, 'Signon messages should be present');
        self::assertSame(0, $signonMessages->signonResponse->status->code);
        self::assertSame(Severity::INFO, $signonMessages->signonResponse->status->severity);

        // Verify credit card messages response exists
        $creditCardMessages = $ofx->creditCardMessagesResponseV1;
        self::assertNotNull($creditCardMessages, 'Credit card messages should be present');
        self::assertCount(1, $creditCardMessages->statementTransactionResponses, 'Should have 1 statement response');

        // Get statement response
        $statementTransactionResponse = $creditCardMessages->statementTransactionResponses[0];
        self::assertSame('CC001', $statementTransactionResponse->transactionUniqueId);
        self::assertSame(0, $statementTransactionResponse->status->code);
        self::assertTrue($statementTransactionResponse->status->isSuccess(), 'Status should indicate success');

        // Get statement
        $statement = $statementTransactionResponse->creditCardStatementResponse;
        self::assertNotNull($statement, 'Credit card statement response should be present');
        self::assertSame('USD', $statement->currency->value);

        // Verify credit card account
        $account = $statement->creditCardAccount;
        self::assertNotNull($account, 'Credit card account should be present');
        self::assertSame('4111111111111111', $account->accountId);

        // Verify transaction list
        $transactionList = $statement->transactionList;
        self::assertNotNull($transactionList, 'Transaction list should be present');
        self::assertSame('2023-12-01', $transactionList->startDate->format('Y-m-d'));
        self::assertSame('2023-12-15', $transactionList->endDate->format('Y-m-d'));

        // Verify transactions
        self::assertCount(3, $transactionList->transactions, 'Credit card statement should have 3 transactions');

        // Transaction 1: Debit (Amazon)
        $firstTransaction = $transactionList->transactions[0];
        self::assertSame(TransactionType::DEBIT, $firstTransaction->type);
        self::assertSame('2023-12-01', $firstTransaction->datePosted->format('Y-m-d'));
        self::assertSame('-125.50', $firstTransaction->amount);
        self::assertSame('CC202312010001', $firstTransaction->transactionId);
        self::assertSame('AMAZON.COM', $firstTransaction->name);
        self::assertSame('Online purchase', $firstTransaction->memo);
        self::assertTrue($firstTransaction->isDebit(), 'Negative amount should be debit');

        // Transaction 2: Debit (Restaurant)
        $secondTransaction = $transactionList->transactions[1];
        self::assertSame(TransactionType::DEBIT, $secondTransaction->type);
        self::assertSame('-42.00', $secondTransaction->amount);
        self::assertSame('RESTAURANT', $secondTransaction->name);

        // Transaction 3: Credit (Payment)
        $thirdTransaction = $transactionList->transactions[2];
        self::assertSame(TransactionType::CREDIT, $thirdTransaction->type);
        self::assertSame('500.00', $thirdTransaction->amount);
        self::assertSame('PAYMENT RECEIVED', $thirdTransaction->name);
        self::assertTrue($thirdTransaction->isCredit(), 'Positive amount should be credit');

        // Verify balances
        $ledgerBalance = $statement->ledgerBalance;
        self::assertNotNull($ledgerBalance, 'Ledger balance should be present');
        self::assertSame('-332.50', $ledgerBalance->amount);

        $availableBalance = $statement->availableBalance;
        self::assertNotNull($availableBalance, 'Available balance should be present');
        self::assertSame('4667.50', $availableBalance->amount);
    }

    #[Test]
    public function parseCreditCardStatementViaListItems(): void
    {
        $ofx = $this->parseFixture('/CreditCard/statement_basic.ofx');

        // Access via statementTransactionResponses
        $creditCardMessages = $ofx->creditCardMessagesResponseV1;
        self::assertCount(1, $creditCardMessages->statementTransactionResponses, 'Should have 1 statement response');

        $statement = $creditCardMessages->statementTransactionResponses[0]->creditCardStatementResponse;
        self::assertSame('4111111111111111', $statement->creditCardAccount->accountId);
    }
}
