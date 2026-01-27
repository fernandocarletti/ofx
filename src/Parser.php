<?php

declare(strict_types=1);

namespace Ofx;

use Ofx\Exception\ParseException;
use Ofx\Header\Header;
use Ofx\Header\HeaderV1;
use Ofx\Header\HeaderV2;
use Ofx\Model\Ofx;
use Ofx\Parser\SgmlParser;
use Ofx\Parser\XmlParser;

/**
 * Main OFX parser - parses OFX v1 (SGML) and v2 (XML) files.
 *
 * Usage:
 * ```php
 * $parser = new Parser();
 * $ofx = $parser->parseFile('/path/to/file.ofx');
 *
 * // Access statements
 * foreach ($ofx->getBankStatements() as $statement) {
 *     foreach ($statement->transactions as $transaction) {
 *         echo $transaction->name . ': ' . $transaction->amount . "\n";
 *     }
 * }
 * ```
 */
final class Parser
{
    /**
     * UTF-8 BOM (Byte Order Mark).
     */
    private const UTF8_BOM = "\xEF\xBB\xBF";

    /**
     * Get the parsed header (available after parsing).
     */
    public ?Header $parsedHeader {
        get => $this->header;
    }

    private ?Header $header = null;

    private readonly SgmlParser $sgmlParser;

    private readonly XmlParser $xmlParser;

    public function __construct()
    {
        $this->sgmlParser = new SgmlParser();
        $this->xmlParser = new XmlParser();
    }

    /**
     * Parse an OFX file from a file path.
     *
     * @param string $path Path to OFX file
     *
     * @throws ParseException If file cannot be read or parsing fails
     *
     * @return Ofx Parsed OFX document
     */
    public function parseFile(string $path): Ofx
    {
        if (!file_exists($path)) {
            throw new ParseException("File not found: $path");
        }

        if (!is_readable($path)) {
            throw new ParseException("File not readable: $path");
        }

        $content = file_get_contents($path);

        if ($content === false) {
            throw new ParseException("Failed to read file: $path");
        }

        return $this->parseString($content);
    }

    /**
     * Parse OFX content from a string.
     *
     * @param string $content Raw OFX content
     *
     * @throws ParseException If parsing fails
     *
     * @return Ofx Parsed OFX document
     */
    public function parseString(string $content): Ofx
    {
        // Detect OFX version and parse header
        $this->header = $this->parseHeader($content);

        // Get message body
        $body = $this->extractBody($content);

        // Convert to correct encoding if needed
        if ($this->header->isVersion1) {
            $encoding = $this->header->encoding;
            if ($encoding !== 'UTF-8') {
                $converted = mb_convert_encoding($body, 'UTF-8', $encoding);
                if ($converted !== false) {
                    $body = $converted;
                }
            }
        }

        // Parse body based on version
        $element = $this->header->isVersion1
            ? $this->sgmlParser->parse($body)
            : $this->xmlParser->parse($body);

        // Convert to OFX model
        return Ofx::fromXml($element);
    }

    /**
     * Parse OFX content from a stream resource.
     *
     * @param resource $stream Stream resource
     *
     * @throws ParseException If parsing fails
     *
     * @return Ofx Parsed OFX document
     */
    public function parseStream($stream): Ofx
    {
        if (!\is_resource($stream)) {
            throw new ParseException('Invalid stream resource');
        }

        $content = stream_get_contents($stream);

        if ($content === false) {
            throw new ParseException('Failed to read from stream');
        }

        return $this->parseString($content);
    }

    /**
     * Parse the OFX header and determine version.
     *
     * @param string $content Raw OFX content
     *
     * @throws ParseException If header is invalid
     *
     * @return Header Parsed header
     */
    private function parseHeader(string $content): Header
    {
        // Strip UTF-8 BOM if present
        if (str_starts_with($content, self::UTF8_BOM)) {
            $content = substr($content, 3);
        }

        // Trim leading whitespace
        $content = ltrim($content);

        // Check if it starts with XML declaration or OFX processing instruction
        if (str_starts_with($content, '<?xml') || str_starts_with($content, '<?OFX')) {
            return HeaderV2::parse($content);
        }

        // Check for OFXv1 header
        if (str_starts_with($content, 'OFXHEADER:')) {
            return HeaderV1::parse($content);
        }

        throw new ParseException(
            'Invalid OFX content: must start with OFXv1 header (OFXHEADER:) or OFXv2 XML declaration',
        );
    }

    /**
     * Extract the message body from OFX content.
     *
     * @param string $content Raw OFX content
     *
     * @throws ParseException If body cannot be extracted
     *
     * @return string Message body
     */
    private function extractBody(string $content): string
    {
        if ($this->header === null) {
            throw new ParseException('Header must be parsed first');
        }

        $endPos = $this->header->isVersion1
            ? HeaderV1::getHeaderEndPosition($content)
            : HeaderV2::getHeaderEndPosition($content);

        $body = substr($content, $endPos);

        // Trim leading/trailing whitespace
        $body = trim($body);

        if ($body === '') {
            throw new ParseException('OFX body is empty');
        }

        return $body;
    }
}
