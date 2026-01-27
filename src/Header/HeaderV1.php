<?php

declare(strict_types=1);

namespace Ofx\Header;

use Ofx\Exception\ParseException;

/**
 * OFX version 1 SGML header.
 *
 * Format (per OFX spec section 2.2.1):
 * ```
 * OFXHEADER:100
 * DATA:OFXSGML
 * VERSION:102
 * SECURITY:NONE
 * ENCODING:USASCII
 * CHARSET:1252
 * COMPRESSION:NONE
 * OLDFILEUID:NONE
 * NEWFILEUID:NONE
 * ```
 *
 * Note: Some FIs insert whitespace after colons or omit line breaks.
 * The parser is lenient about this.
 */
final class HeaderV1 implements Header
{
    /**
     * Regex pattern for parsing OFXv1 headers.
     *
     * Allows for:
     * - Optional whitespace after colons
     * - Missing COMPRESSION field
     * - Various line ending styles
     */
    private const string PATTERN = '/
        OFXHEADER:\s*(?<OFXHEADER>\d+)\s*
        DATA:\s*(?<DATA>[A-Z]+)\s*
        VERSION:\s*(?<VERSION>\d+)\s*
        SECURITY:\s*(?<SECURITY>[\w]+)\s*
        ENCODING:\s*(?<ENCODING>[A-Z0-9-]+)\s*
        CHARSET:\s*(?<CHARSET>[\w-]+)\s*
        (?:COMPRESSION:\s*(?<COMPRESSION>[A-Z]+)\s*)?
        OLDFILEUID:\s*(?<OLDFILEUID>[\w-]+)\s*
        NEWFILEUID:\s*(?<NEWFILEUID>[\w-]+)
    /xs';

    /**
     * Mapping of OFX charset names to PHP charset names.
     */
    private const array CHARSETS = [
        'ISO-8859-1' => 'ISO-8859-1',
        '1252' => 'Windows-1252',
        'NONE' => 'UTF-8',
        'UTF-8' => 'UTF-8',
    ];

    /**
     * PHP-compatible charset name derived from charset field.
     */
    public string $encoding {
        get => self::CHARSETS[$this->charset] ?? 'UTF-8';
    }

    /**
     * Always true for OFXv1.
     */
    public bool $isVersion1 {
        get => true;
    }

    /**
     * Always false for OFXv1.
     */
    public bool $isVersion2 {
        get => false;
    }

    /**
     * Create a new OFXv1 header.
     *
     * @param int $ofxHeader Header version (always 100)
     * @param string $data Data type (always 'OFXSGML')
     * @param int $version OFX version (e.g., 102, 151, 160)
     * @param string $security Security type ('NONE' or 'TYPE1')
     * @param string $rawEncoding Encoding type ('USASCII', 'UNICODE', 'UTF-8')
     * @param string $charset Character set ('ISO-8859-1', '1252', 'NONE')
     * @param string $compression Compression type (always 'NONE')
     * @param string $oldFileUid Old file UID
     * @param string $newFileUid New file UID
     */
    public function __construct(
        public readonly int $ofxHeader,
        public readonly string $data,
        public readonly int $version,
        public readonly string $security,
        public readonly string $rawEncoding,
        public readonly string $charset,
        public readonly string $compression,
        public readonly string $oldFileUid,
        public readonly string $newFileUid,
    ) {}

    /**
     * Parse an OFXv1 header from a string.
     *
     * @param string $header Raw header string
     *
     * @throws ParseException If header is malformed
     *
     * @return self Parsed header
     */
    public static function parse(string $header): self
    {
        if (!preg_match(self::PATTERN, $header, $matches)) {
            throw new ParseException('Invalid OFXv1 header format');
        }

        return new self(
            ofxHeader: (int) $matches['OFXHEADER'],
            data: $matches['DATA'],
            version: (int) $matches['VERSION'],
            security: $matches['SECURITY'],
            rawEncoding: $matches['ENCODING'],
            charset: $matches['CHARSET'],
            // @phpstan-ignore nullCoalesce.offset (COMPRESSION is optional in OFX spec)
            compression: $matches['COMPRESSION'] ?? 'NONE',
            oldFileUid: $matches['OLDFILEUID'],
            newFileUid: $matches['NEWFILEUID'],
        );
    }

    /**
     * Get the byte position where the header ends.
     *
     * @param string $content Full OFX content
     *
     * @throws ParseException If header is not found
     *
     * @return int Position after the header
     */
    public static function getHeaderEndPosition(string $content): int
    {
        if (!preg_match(self::PATTERN, $content, $matches, PREG_OFFSET_CAPTURE)) {
            throw new ParseException('Invalid OFXv1 header format');
        }

        return $matches[0][1] + \strlen($matches[0][0]);
    }
}
