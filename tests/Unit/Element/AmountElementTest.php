<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Element;

use Ofx\Element\AmountElement;
use Ofx\Exception\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for AmountElement.
 *
 * Tests decimal/money value parsing including:
 * - Basic decimal values
 * - Negative values
 * - European decimal separators (comma)
 * - Thousands separators
 * - Scale/precision handling
 */
final class AmountElementTest extends TestCase
{
    #[Test]
    public function convertBasicDecimal(): void
    {
        $element = new AmountElement();

        self::assertSame('123.45', $element->convert('123.45'));
    }

    #[Test]
    public function convertNegativeValue(): void
    {
        $element = new AmountElement();

        self::assertSame('-123.45', $element->convert('-123.45'));
    }

    #[Test]
    public function convertPositiveValueWithSign(): void
    {
        $element = new AmountElement();

        self::assertSame('+123.45', $element->convert('+123.45'));
    }

    #[Test]
    public function convertIntegerValue(): void
    {
        $element = new AmountElement();

        self::assertSame('100', $element->convert('100'));
    }

    #[Test]
    public function convertEuropeanDecimalSeparator(): void
    {
        $element = new AmountElement();

        // European format uses comma as decimal separator
        self::assertSame('123.45', $element->convert('123,45'));
    }

    #[Test]
    public function convertWithThousandsSeparator(): void
    {
        $element = new AmountElement();

        // US format: period decimal, comma thousands
        self::assertSame('1234567.89', $element->convert('1,234,567.89'));
    }

    #[Test]
    public function convertScalesValue(): void
    {
        $element = new AmountElement(scale: 2);

        // bcadd truncates to 2 decimal places (doesn't round)
        self::assertSame('123.45', $element->convert('123.456'));
    }

    #[Test]
    public function convertPadsDecimals(): void
    {
        $element = new AmountElement(scale: 4);

        // Should pad to 4 decimal places
        self::assertSame('123.4500', $element->convert('123.45'));
    }

    #[Test]
    public function convertScalesInteger(): void
    {
        $element = new AmountElement(scale: 2);

        self::assertSame('100.00', $element->convert('100'));
    }

    #[Test]
    public function convertTrimsWhitespace(): void
    {
        $element = new AmountElement();

        self::assertSame('123.45', $element->convert('  123.45  '));
    }

    #[Test]
    public function convertReturnsNullForEmptyString(): void
    {
        $element = new AmountElement();

        self::assertNull($element->convert(''));
    }

    #[Test]
    public function convertThrowsForWhitespaceOnlyString(): void
    {
        $element = new AmountElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid decimal value: ''");

        $element->convert('   ');
    }

    #[Test]
    public function convertReturnsNullForNull(): void
    {
        $element = new AmountElement();

        self::assertNull($element->convert(null));
    }

    #[Test]
    public function convertThrowsForNullWhenRequired(): void
    {
        $element = new AmountElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert(null);
    }

    #[Test]
    public function convertThrowsForEmptyWhenRequired(): void
    {
        $element = new AmountElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert('');
    }

    #[Test]
    #[DataProvider('invalidAmountProvider')]
    public function convertThrowsForInvalidValue(string $value): void
    {
        $element = new AmountElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid decimal value: '$value'");

        $element->convert($value);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidAmountProvider(): array
    {
        return [
            'letters' => ['abc'],
            'currency symbol' => ['$123.45'],
            'multiple decimals' => ['123.45.67'],
            'spaces in middle' => ['123 45'],
        ];
    }

    #[Test]
    public function convertVeryLargeValue(): void
    {
        $element = new AmountElement();

        self::assertSame('99999999999999.99', $element->convert('99999999999999.99'));
    }

    #[Test]
    public function convertVerySmallValue(): void
    {
        $element = new AmountElement();

        self::assertSame('0.0000001', $element->convert('0.0000001'));
    }

    #[Test]
    public function convertZero(): void
    {
        $element = new AmountElement(scale: 2);

        self::assertSame('0.00', $element->convert('0'));
    }

    #[Test]
    public function convertNegativeZero(): void
    {
        $element = new AmountElement(scale: 2);

        // bcadd normalizes -0 to 0
        self::assertSame('0.00', $element->convert('-0'));
    }

    #[Test]
    public function convertScientificNotation(): void
    {
        $element = new AmountElement();

        // PHP's is_numeric() accepts scientific notation
        self::assertSame('1.5E+10', $element->convert('1.5E+10'));
    }
}
