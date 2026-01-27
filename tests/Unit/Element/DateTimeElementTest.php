<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Element;

use DateTimeImmutable;
use Ofx\Element\DateTimeElement;
use Ofx\Exception\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for DateTimeElement.
 *
 * Tests OFX datetime conversion using various formats per OFX spec section 3.2.8.2.
 * DateTimeElement delegates to DateTimeParser, so these tests verify the integration.
 */
final class DateTimeElementTest extends TestCase
{
    #[Test]
    public function convertReturnsNullForNullValue(): void
    {
        $element = new DateTimeElement();
        self::assertNull($element->convert(null), 'Null input should return null');
    }

    #[Test]
    public function convertReturnsNullForEmptyString(): void
    {
        $element = new DateTimeElement();
        self::assertNull($element->convert(''), 'Empty string should return null');
    }

    #[Test]
    public function convertParsesDateOnlyFormat(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20240315');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame('2024-03-15', $result->format('Y-m-d'), 'Should parse YYYYMMDD format');
    }

    #[Test]
    public function convertParsesDateTimeFormat(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20240315143022');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame('2024-03-15 14:30:22', $result->format('Y-m-d H:i:s'), 'Should parse YYYYMMDDHHMMSS format');
    }

    #[Test]
    public function convertParsesDateTimeWithMilliseconds(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20240315143022.500');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame('2024-03-15', $result->format('Y-m-d'), 'Should parse date with milliseconds');
        self::assertSame('14:30:22', $result->format('H:i:s'), 'Should parse time with milliseconds');
    }

    #[Test]
    public function convertParsesDateTimeWithTimezone(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20240315100000[-5:EST]');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        // Result should be normalized to UTC (10:00 EST = 15:00 UTC)
        self::assertSame('UTC', $result->getTimezone()->getName(), 'Should normalize to UTC');
        self::assertSame('15:00:00', $result->format('H:i:s'), 'Should convert to UTC');
    }

    #[Test]
    public function convertParsesDateTimeWithPositiveTimezone(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20240315200000[+9:JST]');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        // 20:00 JST = 11:00 UTC
        self::assertSame('11:00:00', $result->format('H:i:s'), 'Should convert positive timezone to UTC');
    }

    #[Test]
    public function convertThrowsExceptionForRequiredNullValue(): void
    {
        $element = new DateTimeElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert(null);
    }

    #[Test]
    public function convertThrowsExceptionForRequiredEmptyValue(): void
    {
        $element = new DateTimeElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert('');
    }

    #[Test]
    public function convertThrowsExceptionForInvalidFormat(): void
    {
        $element = new DateTimeElement();

        $this->expectException(ValidationException::class);

        $element->convert('invalid-date');
    }

    #[Test]
    public function convertThrowsExceptionForTooShortValue(): void
    {
        $element = new DateTimeElement();

        $this->expectException(ValidationException::class);

        $element->convert('2024');
    }

    #[Test]
    #[DataProvider('validDateTimeProvider')]
    public function convertParsesVariousFormats(string $input, string $expectedDate, string $expectedTime): void
    {
        $element = new DateTimeElement();
        $result = $element->convert($input);

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame($expectedDate, $result->format('Y-m-d'), "Date for '$input'");
        self::assertSame($expectedTime, $result->format('H:i:s'), "Time for '$input'");
    }

    /**
     * @return array<string, array{string, string, string}>
     */
    public static function validDateTimeProvider(): array
    {
        return [
            'date only' => ['20241225', '2024-12-25', '00:00:00'],
            'date and time' => ['20241225235959', '2024-12-25', '23:59:59'],
            'with milliseconds' => ['20241225120000.999', '2024-12-25', '12:00:00'],
            'with zero timezone' => ['20241225120000[0:GMT]', '2024-12-25', '12:00:00'],
        ];
    }

    #[Test]
    public function convertResultIsDateTimeImmutable(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20240101');

        self::assertInstanceOf(DateTimeImmutable::class, $result, 'Result should be DateTimeImmutable');
    }

    #[Test]
    public function convertHandlesLeapYear(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20240229'); // 2024 is a leap year

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame('2024-02-29', $result->format('Y-m-d'), 'Should handle leap year date');
    }

    #[Test]
    public function convertHandlesYearBoundary(): void
    {
        $element = new DateTimeElement();
        $result = $element->convert('20241231235959');

        self::assertSame('2024-12-31', $result->format('Y-m-d'), 'Should handle year-end date');
        self::assertSame('23:59:59', $result->format('H:i:s'), 'Should handle end-of-day time');
    }
}
