<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Element;

use Ofx\Element\IntegerElement;
use Ofx\Exception\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for IntegerElement.
 *
 * Tests integer conversion, max digits validation, and decimal rejection.
 */
final class IntegerElementTest extends TestCase
{
    #[Test]
    public function convertReturnsIntegerForValidValue(): void
    {
        $element = new IntegerElement();
        self::assertSame(42, $element->convert('42'), 'Should convert string to integer');
    }

    #[Test]
    public function convertReturnsNullForNullValue(): void
    {
        $element = new IntegerElement();
        self::assertNull($element->convert(null), 'Null input should return null');
    }

    #[Test]
    public function convertReturnsNullForEmptyString(): void
    {
        $element = new IntegerElement();
        self::assertNull($element->convert(''), 'Empty string should return null');
    }

    #[Test]
    public function convertTrimsWhitespace(): void
    {
        $element = new IntegerElement();
        self::assertSame(123, $element->convert('  123  '), 'Should trim whitespace');
    }

    #[Test]
    public function convertHandlesNegativeNumbers(): void
    {
        $element = new IntegerElement();
        self::assertSame(-500, $element->convert('-500'), 'Should handle negative numbers');
    }

    #[Test]
    public function convertHandlesPositiveSign(): void
    {
        $element = new IntegerElement();
        self::assertSame(100, $element->convert('+100'), 'Should handle positive sign');
    }

    #[Test]
    public function convertHandlesZero(): void
    {
        $element = new IntegerElement();
        self::assertSame(0, $element->convert('0'), 'Should handle zero');
    }

    #[Test]
    public function convertHandlesLeadingZeros(): void
    {
        $element = new IntegerElement();
        self::assertSame(7, $element->convert('007'), 'Leading zeros should be stripped');
        self::assertSame(42, $element->convert('0042'), 'Leading zeros should be stripped');
        self::assertSame(0, $element->convert('000'), 'All zeros should become 0');
    }

    #[Test]
    public function convertThrowsExceptionForDecimalValue(): void
    {
        $element = new IntegerElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid integer value (contains decimal)');

        $element->convert('3.14');
    }

    #[Test]
    public function convertThrowsExceptionForNonNumericValue(): void
    {
        $element = new IntegerElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid integer value');

        $element->convert('abc');
    }

    #[Test]
    public function convertThrowsExceptionForMixedContent(): void
    {
        $element = new IntegerElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid integer value');

        $element->convert('123abc');
    }

    #[Test]
    public function convertRespectsMaxDigits(): void
    {
        $element = new IntegerElement(maxDigits: 4);
        self::assertSame(1234, $element->convert('1234'), 'Exact max digits should succeed');
        self::assertSame(123, $element->convert('123'), 'Fewer digits should succeed');
    }

    #[Test]
    public function convertThrowsExceptionWhenExceedingMaxDigits(): void
    {
        $element = new IntegerElement(maxDigits: 4);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Integer exceeds max digits of 4');

        $element->convert('12345');
    }

    #[Test]
    public function convertCountsDigitsIgnoringSign(): void
    {
        $element = new IntegerElement(maxDigits: 4);
        // -1234 has 4 digits (sign is not counted)
        self::assertSame(-1234, $element->convert('-1234'), 'Sign should not count toward max digits');
    }

    #[Test]
    public function convertThrowsExceptionForRequiredNullValue(): void
    {
        $element = new IntegerElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert(null);
    }

    #[Test]
    public function convertThrowsExceptionForRequiredEmptyValue(): void
    {
        $element = new IntegerElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert('');
    }

    #[Test]
    public function maxDigitsPropertyIsAccessible(): void
    {
        $element = new IntegerElement(maxDigits: 8);
        self::assertSame(8, $element->maxDigits, 'maxDigits property should be readable');
    }

    #[Test]
    public function maxDigitsDefaultsToNull(): void
    {
        $element = new IntegerElement();
        self::assertNull($element->maxDigits, 'maxDigits should default to null (unlimited)');
    }

    #[Test]
    #[DataProvider('validIntegerProvider')]
    public function convertHandlesVariousValidIntegers(string $input, int $expected): void
    {
        $element = new IntegerElement();
        self::assertSame($expected, $element->convert($input), "Should convert '$input' to $expected");
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function validIntegerProvider(): array
    {
        return [
            'positive' => ['12345', 12345],
            'negative' => ['-6789', -6789],
            'zero' => ['0', 0],
            'with spaces' => ['  42  ', 42],
            'large number' => ['999999999', 999999999],
            'with plus sign' => ['+100', 100],
        ];
    }

    #[Test]
    #[DataProvider('invalidIntegerProvider')]
    public function convertRejectsVariousInvalidValues(string $input): void
    {
        $element = new IntegerElement();

        $this->expectException(ValidationException::class);

        $element->convert($input);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidIntegerProvider(): array
    {
        return [
            'decimal' => ['3.14'],
            'letters' => ['abc'],
            'mixed' => ['123abc'],
            'special chars' => ['$100'],
            'comma' => ['1,000'],
            'double minus' => ['--5'],
        ];
    }
}
