<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Element;

use Ofx\Element\BoolElement;
use Ofx\Exception\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for BoolElement.
 *
 * Per OFX spec section 3.2.8.1, boolean values are 'Y' (true) or 'N' (false).
 */
final class BoolElementTest extends TestCase
{
    #[Test]
    public function convertReturnsTrueForY(): void
    {
        $element = new BoolElement();
        self::assertTrue($element->convert('Y'), "'Y' should convert to true");
    }

    #[Test]
    public function convertReturnsFalseForN(): void
    {
        $element = new BoolElement();
        self::assertFalse($element->convert('N'), "'N' should convert to false");
    }

    #[Test]
    public function convertReturnsNullForNullValue(): void
    {
        $element = new BoolElement();
        self::assertNull($element->convert(null), 'Null input should return null');
    }

    #[Test]
    public function convertReturnsNullForEmptyString(): void
    {
        $element = new BoolElement();
        self::assertNull($element->convert(''), 'Empty string should return null');
    }

    #[Test]
    public function convertTrimsWhitespace(): void
    {
        $element = new BoolElement();
        self::assertTrue($element->convert('  Y  '), 'Should trim whitespace around Y');
        self::assertFalse($element->convert('  N  '), 'Should trim whitespace around N');
    }

    #[Test]
    public function convertThrowsExceptionForInvalidValue(): void
    {
        $element = new BoolElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid boolean value: 'yes'. Expected 'Y' or 'N'");

        $element->convert('yes');
    }

    #[Test]
    public function convertThrowsExceptionForLowercaseY(): void
    {
        $element = new BoolElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid boolean value: 'y'. Expected 'Y' or 'N'");

        $element->convert('y');
    }

    #[Test]
    public function convertThrowsExceptionForLowercaseN(): void
    {
        $element = new BoolElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid boolean value: 'n'. Expected 'Y' or 'N'");

        $element->convert('n');
    }

    #[Test]
    public function convertThrowsExceptionForNumericValue(): void
    {
        $element = new BoolElement();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid boolean value: '1'. Expected 'Y' or 'N'");

        $element->convert('1');
    }

    #[Test]
    public function convertThrowsExceptionForRequiredNullValue(): void
    {
        $element = new BoolElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert(null);
    }

    #[Test]
    public function convertThrowsExceptionForRequiredEmptyValue(): void
    {
        $element = new BoolElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert('');
    }

    #[Test]
    #[DataProvider('invalidBooleanValuesProvider')]
    public function convertThrowsExceptionForVariousInvalidValues(string $invalidValue): void
    {
        $element = new BoolElement();

        $this->expectException(ValidationException::class);

        $element->convert($invalidValue);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidBooleanValuesProvider(): array
    {
        return [
            'true string' => ['true'],
            'false string' => ['false'],
            'TRUE string' => ['TRUE'],
            'FALSE string' => ['FALSE'],
            'zero' => ['0'],
            'one' => ['1'],
            'yes' => ['yes'],
            'no' => ['no'],
            'lowercase y' => ['y'],
            'lowercase n' => ['n'],
        ];
    }
}
