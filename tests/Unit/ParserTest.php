<?php

declare(strict_types=1);

namespace Ofx\Tests\Unit;

use Ofx\Exception\ParseException;
use Ofx\Parser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the Parser class.
 *
 * Tests error handling and edge cases for file, string, and stream parsing.
 */
final class ParserTest extends TestCase
{
    private Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    #[Test]
    public function parseFileThrowsExceptionForNonExistentFile(): void
    {
        $this->expectException(ParseException::class);
        $this->expectExceptionMessage('File not found');

        $this->parser->parseFile('/non/existent/path/to/file.ofx');
    }

    #[Test]
    public function parseFileThrowsExceptionForUnreadableFile(): void
    {
        $tempFile = sys_get_temp_dir() . '/ofx_unreadable_' . uniqid() . '.ofx';
        touch($tempFile);
        chmod($tempFile, 0000);

        try {
            $this->expectException(ParseException::class);
            $this->expectExceptionMessage('File not readable');

            $this->parser->parseFile($tempFile);
        } finally {
            chmod($tempFile, 0644);
            unlink($tempFile);
        }
    }

    #[Test]
    public function parseStringThrowsExceptionForInvalidContent(): void
    {
        $this->expectException(ParseException::class);
        $this->expectExceptionMessage('Invalid OFX content');

        $this->parser->parseString('This is not valid OFX content');
    }

    #[Test]
    public function parseStringThrowsExceptionForEmptyBody(): void
    {
        $headerOnly = <<<'OFX'
OFXHEADER:100
DATA:OFXSGML
VERSION:102
SECURITY:NONE
ENCODING:USASCII
CHARSET:1252
COMPRESSION:NONE
OLDFILEUID:NONE
NEWFILEUID:NONE

OFX;

        $this->expectException(ParseException::class);
        $this->expectExceptionMessage('OFX body is empty');

        $this->parser->parseString($headerOnly);
    }

    #[Test]
    public function parseStreamThrowsExceptionForInvalidResource(): void
    {
        $this->expectException(ParseException::class);
        $this->expectExceptionMessage('Invalid stream resource');

        // @phpstan-ignore-next-line Intentionally passing invalid type
        $this->parser->parseStream('not a resource');
    }

    #[Test]
    public function parseStreamSucceedsWithValidResource(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v1_basic.ofx');
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $content);
        rewind($stream);

        $ofx = $this->parser->parseStream($stream);

        self::assertNotNull($ofx, 'Parsing from stream should succeed');
        fclose($stream);
    }

    #[Test]
    public function parseStringSucceedsWithV1Content(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v1_basic.ofx');
        $ofx = $this->parser->parseString($content);

        self::assertNotNull($ofx, 'Parsing V1 content should succeed');
        self::assertTrue($this->parser->parsedHeader->isVersion1, 'Should detect OFXv1');
    }

    #[Test]
    public function parseStringSucceedsWithV2Content(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v2_basic.ofx');
        $ofx = $this->parser->parseString($content);

        self::assertNotNull($ofx, 'Parsing V2 content should succeed');
        self::assertTrue($this->parser->parsedHeader->isVersion2, 'Should detect OFXv2');
    }

    #[Test]
    public function parseStringHandlesLeadingWhitespace(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v1_basic.ofx');
        $contentWithWhitespace = "\n\n  \t" . $content;

        $ofx = $this->parser->parseString($contentWithWhitespace);

        self::assertNotNull($ofx, 'Parsing content with leading whitespace should succeed');
    }

    #[Test]
    public function parseStringHandlesUtf8BomV1(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v1_basic.ofx');
        $bom = "\xEF\xBB\xBF"; // UTF-8 BOM
        $contentWithBom = $bom . $content;

        $ofx = $this->parser->parseString($contentWithBom);

        self::assertNotNull($ofx, 'Should handle UTF-8 BOM with V1 content');
        self::assertTrue($this->parser->parsedHeader->isVersion1, 'Should detect OFXv1 after stripping BOM');
    }

    #[Test]
    public function parseStringHandlesUtf8BomV2(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v2_basic.ofx');
        $bom = "\xEF\xBB\xBF"; // UTF-8 BOM
        $contentWithBom = $bom . $content;

        $ofx = $this->parser->parseString($contentWithBom);

        self::assertNotNull($ofx, 'Should handle UTF-8 BOM with V2 content');
        self::assertTrue($this->parser->parsedHeader->isVersion2, 'Should detect OFXv2 after stripping BOM');
    }

    #[Test]
    public function parseStringDetectsV2FromXmlDeclaration(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v2_basic.ofx');
        $ofx = $this->parser->parseString($content);

        self::assertTrue(
            $this->parser->parsedHeader->isVersion2,
            'Should detect OFXv2 from XML declaration',
        );
    }

    #[Test]
    public function parseStringDetectsV1FromOfxheader(): void
    {
        $content = file_get_contents(FIXTURES_DIR . '/Header/v1_basic.ofx');
        $ofx = $this->parser->parseString($content);

        self::assertTrue(
            $this->parser->parsedHeader->isVersion1,
            'Should detect OFXv1 from OFXHEADER',
        );
    }
}
