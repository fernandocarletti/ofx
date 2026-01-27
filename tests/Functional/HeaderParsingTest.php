<?php

declare(strict_types=1);

namespace Ofx\Tests\Functional;

use Ofx\Header\HeaderV1;
use Ofx\Header\HeaderV2;
use PHPUnit\Framework\Attributes\Test;

/**
 * Functional tests for OFX header parsing.
 *
 * Tests both OFXv1 (SGML) and OFXv2 (XML) header formats,
 * including version detection, charset handling, and property extraction.
 */
final class HeaderParsingTest extends FunctionalTestCase
{
    #[Test]
    public function parseV1BasicHeader(): void
    {
        $this->parseFixture('/Header/v1_basic.ofx');
        $header = $this->parser->parsedHeader;

        self::assertInstanceOf(HeaderV1::class, $header);
        self::assertTrue($header->isVersion1, 'Should be OFXv1');
        self::assertFalse($header->isVersion2, 'Should not be OFXv2');
        self::assertSame(102, $header->version, 'Version should be 102');
        self::assertSame('NONE', $header->security);
        self::assertSame('NONE', $header->oldFileUid);
        self::assertSame('NONE', $header->newFileUid);
        self::assertSame('Windows-1252', $header->encoding, 'Encoding should be Windows-1252');
    }

    #[Test]
    public function parseV1CharsetWindows1252(): void
    {
        $this->parseFixture('/Header/v1_charset_1252.ofx');
        $header = $this->parser->parsedHeader;

        self::assertInstanceOf(HeaderV1::class, $header);
        self::assertSame(160, $header->version, 'Version should be 160');
        self::assertSame('Windows-1252', $header->encoding, 'Encoding should be Windows-1252');

        // Check raw header properties
        self::assertSame('USASCII', $header->rawEncoding, 'Raw encoding should be USASCII');
        self::assertSame('1252', $header->charset, 'Charset should be 1252');
    }

    #[Test]
    public function parseV1CharsetIso8859(): void
    {
        $this->parseFixture('/Header/v1_charset_iso8859.ofx');
        $header = $this->parser->parsedHeader;

        self::assertInstanceOf(HeaderV1::class, $header);
        self::assertSame('ISO-8859-1', $header->encoding, 'Encoding should be ISO-8859-1');
        self::assertSame('ISO-8859-1', $header->charset, 'Charset should be ISO-8859-1');
    }

    #[Test]
    public function parseV2BasicHeader(): void
    {
        $this->parseFixture('/Header/v2_basic.ofx');
        $header = $this->parser->parsedHeader;

        self::assertInstanceOf(HeaderV2::class, $header);
        self::assertFalse($header->isVersion1, 'Should not be OFXv1');
        self::assertTrue($header->isVersion2, 'Should be OFXv2');
        self::assertSame(220, $header->version, 'Version should be 220');
        self::assertSame('NONE', $header->security);
        self::assertSame('NONE', $header->oldFileUid);
        self::assertSame('NONE', $header->newFileUid);
        self::assertSame('UTF-8', $header->encoding, 'OFXv2 encoding is always UTF-8');
    }

    #[Test]
    public function parseV2Version200WithSecurity(): void
    {
        $this->parseFixture('/Header/v2_version200.ofx');
        $header = $this->parser->parsedHeader;

        self::assertInstanceOf(HeaderV2::class, $header);
        self::assertSame(200, $header->version, 'Version should be 200');
        self::assertSame('TYPE1', $header->security, 'Security should be TYPE1');
        self::assertSame('abc123', $header->oldFileUid);
        self::assertSame('def456', $header->newFileUid);
        self::assertSame('UTF-8', $header->encoding, 'OFXv2 encoding is always UTF-8');
    }

    #[Test]
    public function parseV1HeaderDirectly(): void
    {
        $headerContent = <<<'HEADER'
OFXHEADER:100
DATA:OFXSGML
VERSION:151
SECURITY:TYPE1
ENCODING:UNICODE
CHARSET:UTF-8
COMPRESSION:NONE
OLDFILEUID:old123
NEWFILEUID:new456
HEADER;

        $header = HeaderV1::parse($headerContent);

        self::assertSame(100, $header->ofxHeader);
        self::assertSame('OFXSGML', $header->data);
        self::assertSame(151, $header->version);
        self::assertSame('TYPE1', $header->security);
        self::assertSame('UNICODE', $header->rawEncoding);
        self::assertSame('UTF-8', $header->charset);
        self::assertSame('NONE', $header->compression);
        self::assertSame('old123', $header->oldFileUid);
        self::assertSame('new456', $header->newFileUid);
    }

    #[Test]
    public function parseV2HeaderDirectly(): void
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?><?OFX OFXHEADER="200" VERSION="211" SECURITY="NONE" OLDFILEUID="NONE" NEWFILEUID="NONE"?>';

        $header = HeaderV2::parse($content);

        self::assertSame(200, $header->ofxHeader);
        self::assertSame(211, $header->version);
        self::assertSame('NONE', $header->security);
        self::assertSame('NONE', $header->oldFileUid);
        self::assertSame('NONE', $header->newFileUid);
    }

    #[Test]
    public function headerEndPositionV1(): void
    {
        $content = <<<'OFX'
OFXHEADER:100
DATA:OFXSGML
VERSION:102
SECURITY:NONE
ENCODING:USASCII
CHARSET:1252
COMPRESSION:NONE
OLDFILEUID:NONE
NEWFILEUID:NONE

<OFX>
OFX;

        $endPos = HeaderV1::getHeaderEndPosition($content);

        // After the header, we should be at or before <OFX>
        $afterHeader = substr($content, $endPos);
        self::assertStringContainsString('<OFX>', trim($afterHeader));
    }

    #[Test]
    public function headerEndPositionV2(): void
    {
        $content = '<?xml version="1.0"?><?OFX OFXHEADER="200" VERSION="220" SECURITY="NONE" OLDFILEUID="NONE" NEWFILEUID="NONE"?><OFX>';

        $endPos = HeaderV2::getHeaderEndPosition($content);

        $afterHeader = substr($content, $endPos);
        self::assertStringStartsWith('<OFX>', $afterHeader);
    }
}
