<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Element;

use Ofx\Element\OneOfElement;
use Ofx\Exception\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for OneOfElement.
 *
 * Tests validation of enumerated values (like ACCTTYPE, TRNTYPE, etc.).
 */
final class OneOfElementTest extends TestCase
{
    #[Test]
    public function convertReturnsValueWhenAllowed(): void
    {
        $element = new OneOfElement(['CHECKING', 'SAVINGS', 'MONEYMRKT']);
        self::assertSame('CHECKING', $element->convert('CHECKING'), 'Should return allowed value');
    }

    #[Test]
    public function convertReturnsNullForNullValue(): void
    {
        $element = new OneOfElement(['A', 'B', 'C']);
        self::assertNull($element->convert(null), 'Null input should return null');
    }

    #[Test]
    public function convertReturnsNullForEmptyString(): void
    {
        $element = new OneOfElement(['A', 'B', 'C']);
        self::assertNull($element->convert(''), 'Empty string should return null');
    }

    #[Test]
    public function convertTrimsWhitespace(): void
    {
        $element = new OneOfElement(['CREDIT', 'DEBIT']);
        self::assertSame('CREDIT', $element->convert('  CREDIT  '), 'Should trim whitespace');
    }

    #[Test]
    public function convertThrowsExceptionForInvalidValue(): void
    {
        $element = new OneOfElement(['CHECKING', 'SAVINGS']);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid value 'INVALID'. Must be one of: CHECKING, SAVINGS");

        $element->convert('INVALID');
    }

    #[Test]
    public function convertIsCaseSensitive(): void
    {
        $element = new OneOfElement(['CHECKING', 'SAVINGS']);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Invalid value 'checking'");

        $element->convert('checking');
    }

    #[Test]
    public function convertThrowsExceptionForPartialMatch(): void
    {
        $element = new OneOfElement(['CHECK', 'CHECKING']);

        $this->expectException(ValidationException::class);

        // 'CHEC' is not allowed even though it's a prefix of allowed values
        $element->convert('CHEC');
    }

    #[Test]
    public function convertThrowsExceptionForRequiredNullValue(): void
    {
        $element = new OneOfElement(['A', 'B'], required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert(null);
    }

    #[Test]
    public function convertThrowsExceptionForRequiredEmptyValue(): void
    {
        $element = new OneOfElement(['A', 'B'], required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert('');
    }

    #[Test]
    public function allowedValuesPropertyIsAccessible(): void
    {
        $allowed = ['DEBIT', 'CREDIT', 'INT', 'DIV'];
        $element = new OneOfElement($allowed);

        self::assertSame($allowed, $element->allowedValues, 'allowedValues property should be readable');
    }

    #[Test]
    public function constructorNormalizesArrayKeys(): void
    {
        // Associative array should be converted to indexed array
        $element = new OneOfElement(['type1' => 'A', 'type2' => 'B']);
        self::assertSame(['A', 'B'], $element->allowedValues, 'Should extract only values');
    }

    #[Test]
    public function convertAcceptsAllValuesFromList(): void
    {
        $allowed = ['CHECKING', 'SAVINGS', 'MONEYMRKT', 'CREDITLINE', 'CD'];
        $element = new OneOfElement($allowed);

        foreach ($allowed as $value) {
            self::assertSame(
                $value,
                $element->convert($value),
                "Should accept '$value' from allowed values",
            );
        }
    }

    #[Test]
    public function convertWorksWithSingleAllowedValue(): void
    {
        $element = new OneOfElement(['ONLY']);
        self::assertSame('ONLY', $element->convert('ONLY'), 'Should work with single allowed value');
    }

    #[Test]
    public function convertWorksWithNumericStrings(): void
    {
        $element = new OneOfElement(['100', '200', '300']);
        self::assertSame('200', $element->convert('200'), 'Should work with numeric string values');
    }

    #[Test]
    public function errorMessageListsAllAllowedValues(): void
    {
        $element = new OneOfElement(['A', 'B', 'C', 'D']);

        try {
            $element->convert('X');
            self::fail('Expected ValidationException to be thrown');
        } catch (ValidationException $e) {
            self::assertStringContainsString('A, B, C, D', $e->getMessage(), 'Error should list all allowed values');
        }
    }
}
