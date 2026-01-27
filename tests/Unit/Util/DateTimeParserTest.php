<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Util;

use DateTimeImmutable;
use DateTimeZone;
use Ofx\Exception\ValidationException;
use Ofx\Util\DateTimeParser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for DateTimeParser.
 *
 * Tests all OFX datetime format variations:
 * - YYYYMMDD (date only)
 * - YYYYMMDDHHMMSS (date and time)
 * - YYYYMMDDHHMMSS.XXX (with milliseconds)
 * - YYYYMMDDHHMMSS.XXX[offset:tzname] (with timezone)
 */
final class DateTimeParserTest extends TestCase
{
    #[Test]
    public function parseDateOnly(): void
    {
        $result = DateTimeParser::parse('20231215');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('00:00:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithTime(): void
    {
        $result = DateTimeParser::parse('20231215143022');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('14:30:22', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithTimeAndMilliseconds(): void
    {
        $result = DateTimeParser::parse('20231215143022.500');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('14:30:22', $result->format('H:i:s'));
        self::assertSame('500000', $result->format('u'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithNegativeTimezoneOffset(): void
    {
        // 12:00 EST (-5) = 17:00 UTC
        $result = DateTimeParser::parse('20231215120000[-5:EST]');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('17:00:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithPositiveTimezoneOffset(): void
    {
        // 12:00 CET (+1) = 11:00 UTC
        $result = DateTimeParser::parse('20231215120000[1:CET]');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('11:00:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithGmtTimezone(): void
    {
        // 12:00 GMT (0) = 12:00 UTC
        $result = DateTimeParser::parse('20231215120000[0:GMT]');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('12:00:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithFractionalTimezoneOffset(): void
    {
        // OFX uses .30 to mean 30 minutes, e.g., [5.30] = +5:30
        // 12:00 at +5:30 = 06:30 UTC
        $result = DateTimeParser::parse('20231215120000[5.30:IST]');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('06:30:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithNegativeFractionalTimezoneOffset(): void
    {
        // -3.30 means -3:30
        // 12:00 at -3:30 = 15:30 UTC
        $result = DateTimeParser::parse('20231215120000[-3.30:NST]');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('15:30:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithMillisecondsAndTimezone(): void
    {
        $result = DateTimeParser::parse('20231215120000.123[-5:EST]');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('17:00:00', $result->format('H:i:s'));
        self::assertSame('123000', $result->format('u'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseDateWithOffsetOnlyNoTzName(): void
    {
        // Offset without timezone name: [-5]
        $result = DateTimeParser::parse('20231215120000[-5]');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('17:00:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseTrimsWhitespace(): void
    {
        $result = DateTimeParser::parse('  20231215120000  ');

        self::assertSame('2023-12-15', $result->format('Y-m-d'));
        self::assertSame('12:00:00', $result->format('H:i:s'));
    }

    #[Test]
    public function parseLeapSecond(): void
    {
        // OFX allows second value of 60 for leap seconds
        $result = DateTimeParser::parse('20231231235960');

        // PHP normalizes leap second to next minute
        self::assertSame('2024-01-01', $result->format('Y-m-d'));
        self::assertSame('00:00:00', $result->format('H:i:s'));
    }

    #[Test]
    public function parseFeb29LeapYear(): void
    {
        // 2024 is a leap year, Feb 29 should be valid
        $result = DateTimeParser::parse('20240229');

        self::assertSame('2024-02-29', $result->format('Y-m-d'), 'Feb 29 on leap year should be valid');
    }

    #[Test]
    public function parseValidMonthEndDates(): void
    {
        // Test valid last days of months
        self::assertSame('2024-01-31', DateTimeParser::parse('20240131')->format('Y-m-d'), 'Jan 31');
        self::assertSame('2024-03-31', DateTimeParser::parse('20240331')->format('Y-m-d'), 'Mar 31');
        self::assertSame('2024-04-30', DateTimeParser::parse('20240430')->format('Y-m-d'), 'Apr 30');
        self::assertSame('2024-05-31', DateTimeParser::parse('20240531')->format('Y-m-d'), 'May 31');
        self::assertSame('2024-06-30', DateTimeParser::parse('20240630')->format('Y-m-d'), 'Jun 30');
        self::assertSame('2024-12-31', DateTimeParser::parse('20241231')->format('Y-m-d'), 'Dec 31');
    }

    #[Test]
    #[DataProvider('invalidDateTimeProvider')]
    public function parseThrowsExceptionForInvalidFormat(string $value, string $expectedMessage): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage($expectedMessage);

        DateTimeParser::parse($value);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function invalidDateTimeProvider(): array
    {
        return [
            'empty string' => ['', "Invalid OFX datetime format: ''"],
            'too short' => ['2023121', "Invalid OFX datetime format: '2023121'"],
            'invalid month' => ['20231315', "Invalid OFX datetime format: '20231315'"],
            'invalid day' => ['20231232', "Invalid OFX datetime format: '20231232'"],
            'invalid hour' => ['20231215250000', "Invalid OFX datetime format: '20231215250000'"],
            'invalid minute' => ['20231215126000', "Invalid OFX datetime format: '20231215126000'"],
            'invalid second' => ['20231215120061', "Invalid OFX datetime format: '20231215120061'"],
            'letters in date' => ['2023121A', "Invalid OFX datetime format: '2023121A'"],
            'partial time' => ['2023121512', "Invalid OFX datetime format: '2023121512'"],
            'feb 30' => ['20240230', "Invalid calendar date: '20240230'"],
            'feb 31' => ['20240231', "Invalid calendar date: '20240231'"],
            'feb 29 non-leap year' => ['20230229', "Invalid calendar date: '20230229'"],
            'apr 31' => ['20240431', "Invalid calendar date: '20240431'"],
            'jun 31' => ['20240631', "Invalid calendar date: '20240631'"],
            'sep 31' => ['20240931', "Invalid calendar date: '20240931'"],
            'nov 31' => ['20241131', "Invalid calendar date: '20241131'"],
        ];
    }

    #[Test]
    public function parseTimeOnly(): void
    {
        $result = DateTimeParser::parseTime('120000');

        self::assertSame('12:00:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    public function parseTimeWithMilliseconds(): void
    {
        $result = DateTimeParser::parseTime('143022.500');

        self::assertSame('14:30:22', $result->format('H:i:s'));
        self::assertSame('500000', $result->format('u'));
    }

    #[Test]
    public function parseTimeWithTimezone(): void
    {
        // 12:00 EST (-5) = 17:00 UTC
        $result = DateTimeParser::parseTime('120000[-5:EST]');

        self::assertSame('17:00:00', $result->format('H:i:s'));
        self::assertSame('UTC', $result->getTimezone()->getName());
    }

    #[Test]
    #[DataProvider('timezoneAbbreviationsProvider')]
    public function parseHandlesCommonTimezoneAbbreviations(string $tzAbbr, int $expectedOffsetHours): void
    {
        // Parse 12:00 local time
        $result = DateTimeParser::parse("20231215120000[$expectedOffsetHours:$tzAbbr]");

        // Expected UTC time = 12:00 - offset
        $expectedUtc = (new DateTimeImmutable('2023-12-15 12:00:00', new DateTimeZone('UTC')))
            ->modify("-$expectedOffsetHours hours");

        self::assertSame($expectedUtc->format('Y-m-d H:i:s'), $result->format('Y-m-d H:i:s'));
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function timezoneAbbreviationsProvider(): array
    {
        return [
            'EST' => ['EST', -5],
            'EDT' => ['EDT', -4],
            'CST' => ['CST', -6],
            'CDT' => ['CDT', -5],
            'MST' => ['MST', -7],
            'MDT' => ['MDT', -6],
            'PST' => ['PST', -8],
            'PDT' => ['PDT', -7],
            'GMT' => ['GMT', 0],
            'UTC' => ['UTC', 0],
        ];
    }
}
