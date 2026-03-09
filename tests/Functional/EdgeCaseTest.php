<?php

declare(strict_types=1);

namespace Ofx\Tests\Functional;

use PHPUnit\Framework\Attributes\Test;

/**
 * Functional tests for edge cases in OFX parsing.
 *
 * Tests various edge cases including:
 * - Different datetime formats in transactions
 * - Timezone handling
 */
final class EdgeCaseTest extends FunctionalTestCase
{
    #[Test]
    public function parseDatetimeFormats(): void
    {
        $ofx = $this->parseFixture('/EdgeCases/datetime_formats.ofx');

        $statement = $ofx->bankMessagesResponseV1->statementTransactionResponses[0]->statementResponse;
        $transactions = $statement->transactionList->transactions;

        self::assertCount(6, $transactions, 'Should have 6 transactions with different datetime formats');

        // Map by transaction ID for easier testing
        $transactionsByTransactionId = $this->mapTransactionsByTransactionId($transactions);

        // DT001: Date only (20231201)
        $dateOnly = $transactionsByTransactionId['DT001']->datePosted;
        self::assertSame('2023-12-01', $dateOnly->format('Y-m-d'));
        self::assertSame('00:00:00', $dateOnly->format('H:i:s'));

        // DT002: Date with time (20231202143022)
        $dateWithTime = $transactionsByTransactionId['DT002']->datePosted;
        self::assertSame('2023-12-02', $dateWithTime->format('Y-m-d'));
        self::assertSame('14:30:22', $dateWithTime->format('H:i:s'));

        // DT003: Date with time and milliseconds (20231203143022.500)
        $dateWithMillis = $transactionsByTransactionId['DT003']->datePosted;
        self::assertSame('2023-12-03', $dateWithMillis->format('Y-m-d'));
        self::assertSame('14:30:22', $dateWithMillis->format('H:i:s'));
        self::assertSame('500000', $dateWithMillis->format('u'));

        // DT004: Date with EST timezone (20231204120000[-5:EST])
        // 12:00 EST = 17:00 UTC
        $dateWithEst = $transactionsByTransactionId['DT004']->datePosted;
        self::assertSame('2023-12-04', $dateWithEst->format('Y-m-d'));
        self::assertSame('17:00:00', $dateWithEst->format('H:i:s'));
        self::assertSame('UTC', $dateWithEst->getTimezone()->getName());

        // DT005: Date with GMT timezone (20231205120000[0:GMT])
        // 12:00 GMT = 12:00 UTC
        $dateWithGmt = $transactionsByTransactionId['DT005']->datePosted;
        self::assertSame('2023-12-05', $dateWithGmt->format('Y-m-d'));
        self::assertSame('12:00:00', $dateWithGmt->format('H:i:s'));

        // DT006: Full format with PST (20231206120000.123[-8:PST])
        // 12:00 PST = 20:00 UTC
        $dateWithPst = $transactionsByTransactionId['DT006']->datePosted;
        self::assertSame('2023-12-06', $dateWithPst->format('Y-m-d'));
        self::assertSame('20:00:00', $dateWithPst->format('H:i:s'));
        self::assertSame('123000', $dateWithPst->format('u'));
    }

    #[Test]
    public function parseFromString(): void
    {
        $ofxContent = <<<'OFX'
            OFXHEADER:100
            DATA:OFXSGML
            VERSION:102
            SECURITY:NONE
            ENCODING:USASCII
            CHARSET:1252
            COMPRESSION:NONE
            OLDFILEUID:NONE
            NEWFILEUID:NONE

            <OFX>
            <SIGNONMSGSRSV1>
            <SONRS>
            <STATUS>
            <CODE>0
            <SEVERITY>INFO
            </STATUS>
            <DTSERVER>20231215120000
            <LANGUAGE>ENG
            </SONRS>
            </SIGNONMSGSRSV1>
            </OFX>
        OFX;

        $ofx = $this->parser->parseString($ofxContent);

        self::assertNotNull($ofx->signonMessagesResponseV1, 'Signon messages should be parsed from string');
        self::assertTrue($ofx->signonMessagesResponseV1->signonResponse->status->isSuccess(), 'Status should indicate success');
    }

    #[Test]
    public function parseFromStream(): void
    {
        $stream = fopen(FIXTURES_DIR . '/Signon/basic.ofx', 'r');
        self::assertIsResource($stream, 'Stream should be a valid resource');

        try {
            $ofx = $this->parser->parseStream($stream);

            self::assertNotNull($ofx->signonMessagesResponseV1, 'Signon messages should be parsed from stream');
            self::assertTrue($ofx->signonMessagesResponseV1->signonResponse->status->isSuccess(), 'Status should indicate success');
        } finally {
            fclose($stream);
        }
    }

    #[Test]
    public function headerAccessibleAfterParsing(): void
    {
        $this->parseFixture('/Header/v1_basic.ofx');

        $header = $this->parser->parsedHeader;
        self::assertNotNull($header, 'Parsed header should be accessible after parsing');
        self::assertSame(102, $header->version);
    }

    #[Test]
    public function parseUtf8BodyWithLatinHeaderPreservesAccentedCharacters(): void
    {
        $ofx = $this->parseFixture('/EdgeCases/utf8_body_with_latin_header.ofx');

        // Header declares ENCODING:USASCII / CHARSET:1252 but body is UTF-8
        $header = $this->parser->parsedHeader;
        self::assertSame('Windows-1252', $header->encoding);

        $statement = $ofx->bankMessagesResponseV1->statementTransactionResponses[0]->statementResponse;
        $transactions = $statement->transactionList->transactions;

        self::assertCount(2, $transactions);

        // Verify multi-byte UTF-8 characters are preserved, not corrupted
        self::assertSame('Transferência enviada', $transactions[0]->memo);
        self::assertSame('Salário recebido - Março', $transactions[1]->memo);
    }
}
