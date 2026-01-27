<?php

declare(strict_types=1);

namespace Ofx\Header;

use Ofx\Exception\ParseException;

/**
 * OFX version 2 XML header.
 *
 * Format (per OFX spec section 2.2.2):
 * ```
 * <?xml version="1.0" encoding="UTF-8"?>
 * <?OFX OFXHEADER="200" VERSION="220" SECURITY="NONE" OLDFILEUID="NONE" NEWFILEUID="NONE"?>
 * ```
 *
 * OFXv2 always uses UTF-8 encoding.
 */
final class HeaderV2 implements Header
{
    /**
     * Regex pattern for parsing OFXv2 processing instruction.
     */
    private const string PATTERN = '/<\?OFX\s+
        OFXHEADER\s*=\s*"(?<OFXHEADER>\d+)"\s*
        VERSION\s*=\s*"(?<VERSION>\d+)"\s*
        SECURITY\s*=\s*"(?<SECURITY>[\w]+)"\s*
        OLDFILEUID\s*=\s*"(?<OLDFILEUID>[\w-]+)"\s*
        NEWFILEUID\s*=\s*"(?<NEWFILEUID>[\w-]+)"\s*
    \?>/xs';

    /**
     * Regex for XML declaration.
     */
    private const string XML_DECL_PATTERN = '/<\?xml[^?]*\?>\s*/s';

    /**
     * Encoding is always UTF-8 for OFXv2.
     */
    public string $encoding {
        get => 'UTF-8';
    }

    /**
     * Always false for OFXv2.
     */
    public bool $isVersion1 {
        get => false;
    }

    /**
     * Always true for OFXv2.
     */
    public bool $isVersion2 {
        get => true;
    }

    /**
     * Create a new OFXv2 header.
     *
     * @param int $ofxHeader Header version (always 200)
     * @param int $version OFX version (e.g., 200, 201, 202, 203, 210, 211, 220)
     * @param string $security Security type ('NONE' or 'TYPE1')
     * @param string $oldFileUid Old file UID
     * @param string $newFileUid New file UID
     */
    public function __construct(
        public readonly int $ofxHeader,
        public readonly int $version,
        public readonly string $security,
        public readonly string $oldFileUid,
        public readonly string $newFileUid,
    ) {}

    /**
     * Parse an OFXv2 header from a string.
     *
     * @param string $content Raw OFX content (may include XML declaration)
     *
     * @throws ParseException If header is malformed
     *
     * @return self Parsed header
     */
    public static function parse(string $content): self
    {
        if (!preg_match(self::PATTERN, $content, $matches)) {
            throw new ParseException('Invalid OFXv2 header format');
        }

        return new self(
            ofxHeader: (int) $matches['OFXHEADER'],
            version: (int) $matches['VERSION'],
            security: $matches['SECURITY'],
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
        // Skip XML declaration if present
        $offset = 0;
        if (preg_match(self::XML_DECL_PATTERN, $content, $xmlMatch, PREG_OFFSET_CAPTURE)) {
            $offset = $xmlMatch[0][1] + \strlen($xmlMatch[0][0]);
        }

        if (!preg_match(self::PATTERN, $content, $matches, PREG_OFFSET_CAPTURE, $offset)) {
            throw new ParseException('Invalid OFXv2 header format');
        }

        return $matches[0][1] + \strlen($matches[0][0]);
    }
}
