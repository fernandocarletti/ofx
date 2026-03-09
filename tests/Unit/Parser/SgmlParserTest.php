<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit\Parser;

use Ofx\Parser\SgmlParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for SgmlParser.
 *
 * Tests SGML to XML conversion including:
 * - Basic SGML with implicit closing tags
 * - Nested aggregates
 * - Explicit closing tags
 * - Text content escaping
 * - Error handling for malformed SGML
 */
final class SgmlParserTest extends TestCase
{
    private SgmlParser $parser;

    protected function setUp(): void
    {
        $this->parser = new SgmlParser();
    }

    #[Test]
    public function parseSimpleDataElement(): void
    {
        $sgml = '<OFX><NAME>Test Value</OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('Test Value', (string) $xml->NAME);
    }

    #[Test]
    public function parseMultipleDataElements(): void
    {
        $sgml = '<OFX><NAME>John<AGE>30<CITY>Boston</OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('John', (string) $xml->NAME);
        self::assertSame('30', (string) $xml->AGE);
        self::assertSame('Boston', (string) $xml->CITY);
    }

    #[Test]
    public function parseNestedAggregates(): void
    {
        $sgml = '<OFX><PERSON><NAME>John<AGE>30</PERSON></OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('John', (string) $xml->PERSON->NAME);
        self::assertSame('30', (string) $xml->PERSON->AGE);
    }

    #[Test]
    public function parseDeeplyNestedAggregates(): void
    {
        $sgml = '<OFX><A><B><C><VALUE>Deep</C></B></A></OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('Deep', (string) $xml->A->B->C->VALUE);
    }

    #[Test]
    public function parseWithExplicitClosingTagsOnAggregates(): void
    {
        // Explicit closing tags are only supported on aggregates (containers), not data elements
        $sgml = '<OFX><PERSON><NAME>John</PERSON></OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('John', (string) $xml->PERSON->NAME);
    }

    #[Test]
    public function parseWithMixedClosingTagsOnAggregates(): void
    {
        // Mix of implicit and explicit closing tags on aggregates
        $sgml = '<OFX><OUTER><INNER><VALUE>Test</INNER></OUTER></OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('Test', (string) $xml->OUTER->INNER->VALUE);
    }

    #[Test]
    public function parseEscapesSpecialCharacters(): void
    {
        $sgml = '<OFX><NAME>AT&amp;T</OFX>';
        $xml = $this->parser->parse($sgml);

        // &amp; in SGML becomes & in output
        self::assertSame('AT&T', (string) $xml->NAME);
    }

    #[Test]
    public function parseHandlesLessThanInContent(): void
    {
        // This is tricky - normally < would be &lt; but let's see how the parser handles raw text
        $sgml = '<OFX><DESC>A &lt; B</OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('A < B', (string) $xml->DESC);
    }

    #[Test]
    public function parseHandlesQuotesInContent(): void
    {
        $sgml = '<OFX><NAME>John "Johnny" Doe</OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('John "Johnny" Doe', (string) $xml->NAME);
    }

    #[Test]
    public function parseHandlesApostropheInContent(): void
    {
        $sgml = "<OFX><NAME>O'Brien</OFX>";
        $xml = $this->parser->parse($sgml);

        self::assertSame("O'Brien", (string) $xml->NAME);
    }

    #[Test]
    public function parseTrimsContentWhitespace(): void
    {
        $sgml = "<OFX><NAME>  John  </OFX>";
        $xml = $this->parser->parse($sgml);

        self::assertSame('John', (string) $xml->NAME);
    }

    #[Test]
    public function parseHandlesMultilineContent(): void
    {
        $sgml = "<OFX><MEMO>Line 1\nLine 2</OFX>";
        $xml = $this->parser->parse($sgml);

        self::assertSame("Line 1\nLine 2", (string) $xml->MEMO);
    }

    #[Test]
    public function parseHandlesEmptyAggregates(): void
    {
        $sgml = '<OFX><EMPTY></EMPTY></OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertNotNull($xml->EMPTY);
        self::assertSame('', (string) $xml->EMPTY);
    }

    #[Test]
    public function parseHandlesNumericTagNames(): void
    {
        $sgml = '<OFX><TAX1099><AMOUNT>100</TAX1099></OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('100', (string) $xml->TAX1099->AMOUNT);
    }

    #[Test]
    public function parseHandlesTagsWithUnderscores(): void
    {
        $sgml = '<OFX><SOME_TAG>Value</OFX>';
        $xml = $this->parser->parse($sgml);

        self::assertSame('Value', (string) $xml->SOME_TAG);
    }

    #[Test]
    public function parseHandlesTagsWithPeriods(): void
    {
        $sgml = '<OFX><SOME.TAG>Value</OFX>';
        $xml = $this->parser->parse($sgml);

        // SimpleXML converts periods in tag names, access via children()
        $children = $xml->children();
        $tagFound = false;
        foreach ($children as $name => $value) {
            if ($name === 'SOME.TAG') {
                self::assertSame('Value', (string) $value);
                $tagFound = true;
            }
        }
        self::assertTrue($tagFound);
    }

    #[Test]
    public function parseHandlesCrLfLineEndings(): void
    {
        $sgml = "<OFX>\r\n<NAME>John\r\n</OFX>";
        $xml = $this->parser->parse($sgml);

        self::assertSame('John', (string) $xml->NAME);
    }

    #[Test]
    public function parseHandlesCrLineEndings(): void
    {
        $sgml = "<OFX>\r<NAME>John\r</OFX>";
        $xml = $this->parser->parse($sgml);

        self::assertSame('John', (string) $xml->NAME);
    }

    #[Test]
    public function parseWithExplicitClosingTagsOnDataElements(): void
    {
        // Many banks produce SGML files with explicit closing tags on data elements
        $sgml = <<<'SGML'
            <OFX>
            <STATUS>
            <CODE>0</CODE>
            <SEVERITY>INFO</SEVERITY>
            </STATUS>
            </OFX>
            SGML;

        $xml = $this->parser->parse($sgml);

        self::assertSame('0', (string) $xml->STATUS->CODE);
        self::assertSame('INFO', (string) $xml->STATUS->SEVERITY);
    }

    #[Test]
    public function parseWithMixedImplicitAndExplicitClosingTagsOnDataElements(): void
    {
        // Mix of implicit and explicit closing tags on data elements
        $sgml = <<<'SGML'
            <OFX>
            <STMTTRN>
            <FITID>12345</FITID>
            <TRNTYPE>CREDIT
            <DTPOSTED>20260206</DTPOSTED>
            <TRNAMT>1500
            <MEMO>Payment received</MEMO>
            </STMTTRN>
            </OFX>
            SGML;

        $xml = $this->parser->parse($sgml);

        self::assertSame('12345', (string) $xml->STMTTRN->FITID);
        self::assertSame('CREDIT', (string) $xml->STMTTRN->TRNTYPE);
        self::assertSame('20260206', (string) $xml->STMTTRN->DTPOSTED);
        self::assertSame('1500', (string) $xml->STMTTRN->TRNAMT);
        self::assertSame('Payment received', (string) $xml->STMTTRN->MEMO);
    }

    #[Test]
    public function parseIgnoresUnmatchedClosingTag(): void
    {
        // Unmatched closing tags are ignored for resilience against
        // bank-specific non-standard elements and redundant data element
        // closing tags (e.g. <CODE>0</CODE> where CODE was auto-closed).
        $xml = $this->parser->parse('<OFX><NAME>Test</UNKNOWN></OFX>');

        self::assertSame('Test', (string) $xml->NAME);
    }

    #[Test]
    public function parseTypicalBankTransaction(): void
    {
        $sgml = <<<'SGML'
            <OFX>
            <STMTTRN>
            <TRNTYPE>DEBIT
            <DTPOSTED>20231215
            <TRNAMT>-50.00
            <FITID>12345
            <NAME>Coffee Shop
            <MEMO>Morning coffee
            </STMTTRN>
            </OFX>
            SGML;

        $xml = $this->parser->parse($sgml);

        self::assertSame('DEBIT', (string) $xml->STMTTRN->TRNTYPE);
        self::assertSame('20231215', (string) $xml->STMTTRN->DTPOSTED);
        self::assertSame('-50.00', (string) $xml->STMTTRN->TRNAMT);
        self::assertSame('12345', (string) $xml->STMTTRN->FITID);
        self::assertSame('Coffee Shop', (string) $xml->STMTTRN->NAME);
        self::assertSame('Morning coffee', (string) $xml->STMTTRN->MEMO);
    }

    #[Test]
    public function parseMultipleSiblingAggregates(): void
    {
        $sgml = <<<'SGML'
            <OFX>
            <ITEM><VALUE>A</ITEM>
            <ITEM><VALUE>B</ITEM>
            <ITEM><VALUE>C</ITEM>
            </OFX>
            SGML;

        $xml = $this->parser->parse($sgml);

        self::assertCount(3, $xml->ITEM);
        self::assertSame('A', (string) $xml->ITEM[0]->VALUE);
        self::assertSame('B', (string) $xml->ITEM[1]->VALUE);
        self::assertSame('C', (string) $xml->ITEM[2]->VALUE);
    }
}
