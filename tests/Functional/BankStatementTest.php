<?php

declare(strict_types=1);

namespace Ofx\Tests\Functional;

use Ofx\Enum\AccountType;
use Ofx\Enum\Language;
use Ofx\Enum\Severity;
use Ofx\Enum\TransactionType;
use PHPUnit\Framework\Attributes\Test;

/**
 * Functional tests for bank statement parsing.
 *
 * Tests complete bank statement OFX files including:
 * - Account information
 * - Transaction list with all types
 * - Balance information
 */
final class BankStatementTest extends FunctionalTestCase
{
    #[Test]
    public function parseBasicBankStatement(): void
    {
        $ofx = $this->parseFixture('/Bank/statement_basic.ofx');

        // Verify signon response
        $signonMessages = $ofx->signonMessagesResponseV1;
        self::assertNotNull($signonMessages, 'Signon messages should be present');
        self::assertNotNull($signonMessages->signonResponse, 'Signon response should be present');
        self::assertSame(0, $signonMessages->signonResponse->status->code);
        self::assertSame(Severity::INFO, $signonMessages->signonResponse->status->severity);
        self::assertTrue($signonMessages->signonResponse->status->isSuccess(), 'Status should indicate success');

        // Verify bank messages response exists
        $bankMessages = $ofx->bankMessagesResponseV1;
        self::assertNotNull($bankMessages, 'Bank messages should be present');
        self::assertCount(1, $bankMessages->statementTransactionResponses, 'Should have 1 statement response');

        // Get statement response
        $statementTransactionResponse = $bankMessages->statementTransactionResponses[0];
        self::assertSame('1001', $statementTransactionResponse->transactionUniqueId);
        self::assertSame(0, $statementTransactionResponse->status->code);

        // Get statement
        $statement = $statementTransactionResponse->statementResponse;
        self::assertNotNull($statement, 'Statement response should be present');
        self::assertSame('USD', $statement->currency->value);

        // Verify account
        $account = $statement->bankAccount;
        self::assertNotNull($account, 'Bank account should be present');
        self::assertSame('123456789', $account->routingNumber);
        self::assertSame('987654321', $account->accountId);
        self::assertSame(AccountType::CHECKING, $account->accountType);

        // Verify transaction list
        $transactionList = $statement->transactionList;
        self::assertNotNull($transactionList, 'Transaction list should be present');
        self::assertSame('2023-12-01', $transactionList->startDate->format('Y-m-d'));
        self::assertSame('2023-12-15', $transactionList->endDate->format('Y-m-d'));

        // Verify transactions
        self::assertCount(3, $transactionList->transactions, 'Basic statement should have 3 transactions');

        // Transaction 1: Credit (payroll)
        $firstTransaction = $transactionList->transactions[0];
        self::assertSame(TransactionType::CREDIT, $firstTransaction->type);
        self::assertSame('2023-12-01', $firstTransaction->datePosted->format('Y-m-d'));
        self::assertSame('1500.00', $firstTransaction->amount);
        self::assertSame('202312010001', $firstTransaction->transactionId);
        self::assertSame('PAYROLL DEPOSIT', $firstTransaction->name);
        self::assertSame('Monthly salary', $firstTransaction->memo);
        self::assertTrue($firstTransaction->isCredit(), 'Positive amount should be credit');
        self::assertFalse($firstTransaction->isDebit(), 'Positive amount should not be debit');

        // Transaction 2: Debit (coffee shop)
        $secondTransaction = $transactionList->transactions[1];
        self::assertSame(TransactionType::DEBIT, $secondTransaction->type);
        self::assertSame('-45.50', $secondTransaction->amount);
        self::assertSame('202312050001', $secondTransaction->transactionId);
        self::assertSame('COFFEE SHOP', $secondTransaction->name);
        self::assertFalse($secondTransaction->isCredit(), 'Negative amount should not be credit');
        self::assertTrue($secondTransaction->isDebit(), 'Negative amount should be debit');

        // Transaction 3: Check
        $thirdTransaction = $transactionList->transactions[2];
        self::assertSame(TransactionType::CHECK, $thirdTransaction->type);
        self::assertSame('-200.00', $thirdTransaction->amount);
        self::assertSame('1234', $thirdTransaction->checkNumber);
        self::assertSame('LANDLORD', $thirdTransaction->name);

        // Verify balances
        $ledgerBalance = $statement->ledgerBalance;
        self::assertNotNull($ledgerBalance, 'Ledger balance should be present');
        self::assertSame('5250.00', $ledgerBalance->amount);
        self::assertSame('2023-12-15', $ledgerBalance->asOfDate->format('Y-m-d'));

        $availableBalance = $statement->availableBalance;
        self::assertNotNull($availableBalance, 'Available balance should be present');
        self::assertSame('5200.00', $availableBalance->amount);
    }

    #[Test]
    public function parseAllTransactionTypes(): void
    {
        $ofx = $this->parseFixture('/Bank/statement_all_trantypes.ofx');

        $statement = $ofx->bankMessagesResponseV1->statementTransactionResponses[0]->statementResponse;
        $transactions = $statement->transactionList->transactions;

        self::assertCount(17, $transactions, 'Should have all 17 transaction types');

        // Map transactions by transaction ID for easier testing
        $transactionsByTransactionId = $this->mapTransactionsByTransactionId($transactions);

        // Verify each transaction type
        self::assertSame(TransactionType::CREDIT, $transactionsByTransactionId['TRN001']->type);
        self::assertSame(TransactionType::DEBIT, $transactionsByTransactionId['TRN002']->type);
        self::assertSame(TransactionType::INTEREST, $transactionsByTransactionId['TRN003']->type);
        self::assertSame(TransactionType::DIVIDEND, $transactionsByTransactionId['TRN004']->type);
        self::assertSame(TransactionType::FEE, $transactionsByTransactionId['TRN005']->type);
        self::assertSame(TransactionType::SERVICE_CHARGE, $transactionsByTransactionId['TRN006']->type);
        self::assertSame(TransactionType::DEPOSIT, $transactionsByTransactionId['TRN007']->type);
        self::assertSame(TransactionType::ATM, $transactionsByTransactionId['TRN008']->type);
        self::assertSame(TransactionType::POS, $transactionsByTransactionId['TRN009']->type);
        self::assertSame(TransactionType::TRANSFER, $transactionsByTransactionId['TRN010']->type);
        self::assertSame(TransactionType::CHECK, $transactionsByTransactionId['TRN011']->type);
        self::assertSame(TransactionType::PAYMENT, $transactionsByTransactionId['TRN012']->type);
        self::assertSame(TransactionType::CASH, $transactionsByTransactionId['TRN013']->type);
        self::assertSame(TransactionType::DIRECT_DEPOSIT, $transactionsByTransactionId['TRN014']->type);
        self::assertSame(TransactionType::DIRECT_DEBIT, $transactionsByTransactionId['TRN015']->type);
        self::assertSame(TransactionType::RECURRING_PAYMENT, $transactionsByTransactionId['TRN016']->type);
        self::assertSame(TransactionType::OTHER, $transactionsByTransactionId['TRN017']->type);

        // Verify check number for CHECK transaction
        self::assertSame('1001', $transactionsByTransactionId['TRN011']->checkNumber);

        // Verify credit/debit logic
        self::assertTrue($transactionsByTransactionId['TRN001']->isCredit(), '100.00 should be credit');
        self::assertTrue($transactionsByTransactionId['TRN002']->isDebit(), '-50.00 should be debit');
        self::assertTrue($transactionsByTransactionId['TRN003']->isCredit(), '5.25 interest should be credit');
        self::assertTrue($transactionsByTransactionId['TRN005']->isDebit(), '-2.50 fee should be debit');
    }

    #[Test]
    public function parseBankStatementTransactionsViaListItems(): void
    {
        $ofx = $this->parseFixture('/Bank/statement_basic.ofx');

        // Access via statementTransactionResponses (property hook on listItems)
        $bankMessages = $ofx->bankMessagesResponseV1;
        self::assertCount(1, $bankMessages->statementTransactionResponses, 'Should have 1 statement response');

        $statementTransactionResponse = $bankMessages->statementTransactionResponses[0];
        $statement = $statementTransactionResponse->statementResponse;
        self::assertSame('987654321', $statement->bankAccount->accountId);
    }

    #[Test]
    public function parseSgmlWithExplicitClosingTagsAndNonStandardElements(): void
    {
        $ofx = $this->parseFixture('/Bank/statement_explicit_closing_tags.ofx');

        // Verify signon
        $signonMessages = $ofx->signonMessagesResponseV1;
        self::assertNotNull($signonMessages);
        self::assertSame(0, $signonMessages->signonResponse->status->code);
        self::assertSame(Severity::INFO, $signonMessages->signonResponse->status->severity);
        self::assertSame(Language::POR, $signonMessages->signonResponse->language);
        self::assertSame('ACME BANK', $signonMessages->signonResponse->financialInstitution->organization);

        // Verify bank statement
        $bankMessages = $ofx->bankMessagesResponseV1;
        self::assertNotNull($bankMessages);
        self::assertCount(1, $bankMessages->statementTransactionResponses);

        $statement = $bankMessages->statementTransactionResponses[0]->statementResponse;
        self::assertSame('BRL', $statement->currency->value);

        // Verify account
        $account = $statement->bankAccount;
        self::assertSame('12345678', $account->accountId);
        self::assertSame('100', $account->branchId);
        self::assertSame(AccountType::CHECKING, $account->accountType);

        // Verify transaction list
        $transactionList = $statement->transactionList;
        self::assertSame('2026-02-01', $transactionList->startDate->format('Y-m-d'));
        self::assertSame('2026-02-28', $transactionList->endDate->format('Y-m-d'));

        // Verify transactions
        self::assertCount(3, $transactionList->transactions);

        // Transaction 1: Credit
        $txn1 = $transactionList->transactions[0];
        self::assertSame(TransactionType::CREDIT, $txn1->type);
        self::assertSame('2500.00', $txn1->amount);
        self::assertSame('1000000001', $txn1->transactionId);
        self::assertSame('Pix Received', $txn1->memo);
        self::assertTrue($txn1->isCredit());

        // Transaction 2: Debit with CHECKNUM (and non-standard NUMREF which should be skipped)
        $txn2 = $transactionList->transactions[1];
        self::assertSame(TransactionType::DEBIT, $txn2->type);
        self::assertSame('-350.00', $txn2->amount);
        self::assertSame('99990001', $txn2->checkNumber);
        self::assertSame('Bill Payment', $txn2->memo);
        self::assertTrue($txn2->isDebit());

        // Transaction 3: Debit
        $txn3 = $transactionList->transactions[2];
        self::assertSame(TransactionType::DEBIT, $txn3->type);
        self::assertSame('-150.00', $txn3->amount);
        self::assertSame('Pix Sent', $txn3->memo);

        // Verify balance
        $ledgerBalance = $statement->ledgerBalance;
        self::assertSame('2000.00', $ledgerBalance->amount);
        self::assertSame('2026-02-18', $ledgerBalance->asOfDate->format('Y-m-d'));
    }
}
