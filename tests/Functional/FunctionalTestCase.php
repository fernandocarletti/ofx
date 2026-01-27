<?php

declare(strict_types=1);

namespace Ofx\Tests\Functional;

use Ofx\Model\Bank\Transaction;
use Ofx\Model\Ofx;
use Ofx\Parser;
use PHPUnit\Framework\TestCase;

/**
 * Base test case for functional tests.
 *
 * Provides common utilities for parsing OFX fixtures and asserting results.
 */
abstract class FunctionalTestCase extends TestCase
{
    protected Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    /**
     * Parse an OFX fixture file.
     *
     * @param string $relativePath Path relative to FIXTURES_DIR (e.g., '/Bank/statement_basic.ofx')
     */
    protected function parseFixture(string $relativePath): Ofx
    {
        return $this->parser->parseFile(FIXTURES_DIR . $relativePath);
    }

    /**
     * Map transactions by their transaction ID for easier testing.
     *
     * @param array<Transaction> $transactions
     *
     * @return array<string, Transaction>
     */
    protected function mapTransactionsByTransactionId(array $transactions): array
    {
        $transactionsByTransactionId = [];
        foreach ($transactions as $transaction) {
            $transactionsByTransactionId[$transaction->transactionId] = $transaction;
        }

        return $transactionsByTransactionId;
    }
}
