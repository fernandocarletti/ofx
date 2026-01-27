<?php

declare(strict_types=1);

namespace Ofx\Tests\Functional;

use Ofx\Enum\Severity;
use PHPUnit\Framework\Attributes\Test;

/**
 * Functional tests for signon response parsing.
 *
 * Tests signon-specific OFX structures including:
 * - Status codes (success, warning, error)
 * - Financial institution information
 * - Server date/time
 */
final class SignonTest extends FunctionalTestCase
{
    #[Test]
    public function parseSuccessfulSignon(): void
    {
        $ofx = $this->parseFixture('/Signon/basic.ofx');

        $signonMessages = $ofx->signonMessagesResponseV1;
        self::assertNotNull($signonMessages, 'Signon messages should be present');

        $signonResponse = $signonMessages->signonResponse;
        self::assertNotNull($signonResponse, 'Signon response should be present');

        // Verify status
        $status = $signonResponse->status;
        self::assertSame(0, $status->code);
        self::assertSame(Severity::INFO, $status->severity);
        self::assertTrue($status->isSuccess(), 'Code 0 should indicate success');
        self::assertFalse($status->isError(), 'INFO severity should not be error');
        self::assertNull($status->message, 'Success status should have no message');

        // Verify server datetime
        self::assertSame('2023-12-15', $signonResponse->serverDate->format('Y-m-d'));
        self::assertSame('12:00:00', $signonResponse->serverDate->format('H:i:s'));

        // Verify language
        self::assertSame('ENG', $signonResponse->language->value);

        // Verify FI information
        $financialInstitution = $signonResponse->financialInstitution;
        self::assertNotNull($financialInstitution, 'Financial institution should be present');
        self::assertSame('Test Bank', $financialInstitution->organization);
        self::assertSame('12345', $financialInstitution->financialInstitutionId);
    }

    #[Test]
    public function parseErrorSignon(): void
    {
        $ofx = $this->parseFixture('/Signon/error.ofx');

        $signonMessages = $ofx->signonMessagesResponseV1;
        self::assertNotNull($signonMessages, 'Signon messages should be present');

        $signonResponse = $signonMessages->signonResponse;
        self::assertNotNull($signonResponse, 'Signon response should be present');

        // Verify error status
        $status = $signonResponse->status;
        self::assertSame(2000, $status->code);
        self::assertSame(Severity::ERROR, $status->severity);
        self::assertFalse($status->isSuccess(), 'Code 2000 should not indicate success');
        self::assertTrue($status->isError(), 'ERROR severity should be error');
        self::assertSame('General error occurred', $status->message);
    }

    #[Test]
    public function signonDatetimeIsParsedCorrectly(): void
    {
        $ofx = $this->parseFixture('/Signon/basic.ofx');

        $signonResponse = $ofx->signonMessagesResponseV1->signonResponse;

        // The fixture has 20231215120000 which should be 2023-12-15 12:00:00 UTC
        $serverDate = $signonResponse->serverDate;

        self::assertSame(2023, (int) $serverDate->format('Y'));
        self::assertSame(12, (int) $serverDate->format('m'));
        self::assertSame(15, (int) $serverDate->format('d'));
        self::assertSame(12, (int) $serverDate->format('H'));
        self::assertSame(0, (int) $serverDate->format('i'));
        self::assertSame(0, (int) $serverDate->format('s'));
        self::assertSame('UTC', $serverDate->getTimezone()->getName());
    }
}
