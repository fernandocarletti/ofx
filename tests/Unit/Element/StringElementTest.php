<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Element;

use Ofx\Element\StringElement;
use Ofx\Exception\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for StringElement.
 *
 * Tests string conversion, HTML entity decoding, whitespace handling, and max length validation.
 */
final class StringElementTest extends TestCase
{
    #[Test]
    public function convertReturnsNullForNullValue(): void
    {
        $element = new StringElement();
        self::assertNull($element->convert(null), 'Null input should return null');
    }

    #[Test]
    public function convertReturnsNullForEmptyString(): void
    {
        $element = new StringElement();
        self::assertNull($element->convert(''), 'Empty string should return null');
    }

    #[Test]
    public function convertReturnsNullForWhitespaceOnlyString(): void
    {
        $element = new StringElement();
        self::assertNull($element->convert('   '), 'Whitespace-only string should return null');
    }

    #[Test]
    public function convertTrimsWhitespace(): void
    {
        $element = new StringElement();
        self::assertSame('hello', $element->convert('  hello  '), 'Should trim leading and trailing whitespace');
    }

    #[Test]
    public function convertDecodesHtmlEntities(): void
    {
        $element = new StringElement();
        self::assertSame('Tom & Jerry', $element->convert('Tom &amp; Jerry'), 'Should decode &amp;');
        self::assertSame('<tag>', $element->convert('&lt;tag&gt;'), 'Should decode &lt; and &gt;');
        self::assertSame('"quoted"', $element->convert('&quot;quoted&quot;'), 'Should decode &quot;');
        self::assertSame("it's", $element->convert("it&apos;s"), 'Should decode &apos;');
    }

    #[Test]
    public function convertHandlesNbspEntity(): void
    {
        $element = new StringElement();
        self::assertSame('hello world', $element->convert('hello&nbsp;world'), 'Should convert &nbsp; to regular space');
    }

    #[Test]
    public function convertRespectsMaxLength(): void
    {
        $element = new StringElement(maxLength: 10);
        self::assertSame('1234567890', $element->convert('1234567890'), 'Exact max length should succeed');
    }

    #[Test]
    public function convertThrowsExceptionWhenExceedingMaxLength(): void
    {
        $element = new StringElement(maxLength: 5);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('String exceeds max length of 5');

        $element->convert('123456');
    }

    #[Test]
    public function convertHandlesUnicodeCharactersForMaxLength(): void
    {
        $element = new StringElement(maxLength: 5);
        // Unicode characters should count as single characters, not bytes
        self::assertSame('日本語ab', $element->convert('日本語ab'), 'Should count unicode characters correctly');
    }

    #[Test]
    public function convertThrowsExceptionForRequiredNullValue(): void
    {
        $element = new StringElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert(null);
    }

    #[Test]
    public function convertThrowsExceptionForRequiredEmptyValue(): void
    {
        $element = new StringElement(required: true);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Value is required');

        $element->convert('');
    }

    #[Test]
    public function maxLengthPropertyIsAccessible(): void
    {
        $element = new StringElement(maxLength: 32);
        self::assertSame(32, $element->maxLength, 'maxLength property should be readable');
    }

    #[Test]
    public function maxLengthDefaultsToNull(): void
    {
        $element = new StringElement();
        self::assertNull($element->maxLength, 'maxLength should default to null (unlimited)');
    }

    #[Test]
    #[DataProvider('htmlEntityProvider')]
    public function convertDecodesVariousHtmlEntities(string $input, string $expected): void
    {
        $element = new StringElement();
        self::assertSame($expected, $element->convert($input), "Should decode '$input' to '$expected'");
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function htmlEntityProvider(): array
    {
        return [
            'ampersand' => ['AT&amp;T', 'AT&T'],
            'less than' => ['5 &lt; 10', '5 < 10'],
            'greater than' => ['10 &gt; 5', '10 > 5'],
            'double quote' => ['&quot;hello&quot;', '"hello"'],
            'apostrophe' => ['it&apos;s', "it's"],
            'nbsp' => ['non&nbsp;breaking', 'non breaking'],
            'numeric entity' => ['&#65;BC', 'ABC'],
            'hex entity' => ['&#x41;BC', 'ABC'],
        ];
    }
}
