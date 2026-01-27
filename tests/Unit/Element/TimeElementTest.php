<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Element;

use DateTimeImmutable;
use Ofx\Element\TimeElement;
use Ofx\Exception\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for TimeElement.
 *
 * Tests OFX time-only conversion per OFX spec section 3.2.8.3.
 * TimeElement delegates to DateTimeParser::parseTime().
 */
final class TimeElementTest extends TestCase
{
    #[Test]
    public function convertReturnsNullForNullValue(): void
    {
        $element = new TimeElement();
        self::assertNull($element->convert(null), 'Null input should return null');
    }

    #[Test]
    public function convertReturnsNullForEmptyString(): void
    {
        $element = new TimeElement();
        self::assertNull($element->convert(''), 'Empty string should return null');
    }

    #[Test]
    public function convertParsesBasicTimeFormat(): void
    {
        $element = new TimeElement();
        $result = $element->convert('143022');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame('14:30:22', $result->format('H:i:s'), 'Should parse HHMMSS format');
    }

    #[Test]
    public function convertParsesTimeWithMilliseconds(): void
    {
        $element = new TimeElement();
        $result = $element->convert('143022.500');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame('14:30:22', $result->format('H:i:s'), 'Should parse time with milliseconds');
    }

    #[Test]
    public function convertParsesTimeWithTimezone(): void
    {
        $element = new TimeElement();
        $result = $element->convert('100000[-5:EST]');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        // 10:00 EST = 15:00 UTC
        self::assertSame('15:00:00', $result->format('H:i:s'), 'Should convert to UTC');
        self::assertSame('UTC', $result->getTimezone()->getName(), 'Should normalize to UTC');
    }

    #[Test]
    public function convertParsesTimeWithPositiveTimezone(): void
    {
        $element = new TimeElement();
        $result = $element->convert('200000[+9:JST]');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        // 20:00 JST = 11:00 UTC
        self::assertSame('11:00:00', $result->format('H:i:s'), 'Should convert positive timezone to UTC');
    }

    #[Test]
    public function convertThrowsExceptionForRequiredNullValue(): void
    {
        $element = new TimeElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert(null);
    }

    #[Test]
    public function convertThrowsExceptionForRequiredEmptyValue(): void
    {
        $element = new TimeElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert('');
    }

    #[Test]
    public function convertThrowsExceptionForInvalidFormat(): void
    {
        $element = new TimeElement();

        $this->expectException(ValidationException::class);

        $element->convert('invalid');
    }

    #[Test]
    public function convertThrowsExceptionForTooShortValue(): void
    {
        $element = new TimeElement();

        $this->expectException(ValidationException::class);

        $element->convert('1430');
    }

    #[Test]
    #[DataProvider('validTimeProvider')]
    public function convertParsesVariousFormats(string $input, string $expectedTime): void
    {
        $element = new TimeElement();
        $result = $element->convert($input);

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame($expectedTime, $result->format('H:i:s'), "Time for '$input'");
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function validTimeProvider(): array
    {
        return [
            'midnight' => ['000000', '00:00:00'],
            'noon' => ['120000', '12:00:00'],
            'end of day' => ['235959', '23:59:59'],
            'with milliseconds' => ['120000.999', '12:00:00'],
            'with GMT timezone' => ['120000[0:GMT]', '12:00:00'],
        ];
    }

    #[Test]
    public function convertResultIsDateTimeImmutable(): void
    {
        $element = new TimeElement();
        $result = $element->convert('120000');

        self::assertInstanceOf(DateTimeImmutable::class, $result, 'Result should be DateTimeImmutable');
    }

    #[Test]
    public function convertHandlesMidnight(): void
    {
        $element = new TimeElement();
        $result = $element->convert('000000');

        self::assertSame('00:00:00', $result->format('H:i:s'), 'Should handle midnight');
    }

    #[Test]
    public function convertHandlesEndOfDay(): void
    {
        $element = new TimeElement();
        $result = $element->convert('235959');

        self::assertSame('23:59:59', $result->format('H:i:s'), 'Should handle 23:59:59');
    }

    #[Test]
    public function convertParsesTimeWithFractionalTimezone(): void
    {
        $element = new TimeElement();
        // India Standard Time is +5:30
        $result = $element->convert('173000[+5.30:IST]');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        // 17:30 IST = 12:00 UTC
        self::assertSame('12:00:00', $result->format('H:i:s'), 'Should handle fractional timezone');
    }
}
