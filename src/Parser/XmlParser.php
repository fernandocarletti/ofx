<?php

declare(strict_types=1);

namespace Ofx\Parser;

use LibXMLError;
use Ofx\Exception\ParseException;
use SimpleXMLElement;

/**
 * Parser for OFX v2 XML format.
 *
 * OFXv2 is well-formed XML, so we can use PHP's built-in XML parser.
 * This class handles XML-specific preprocessing and error handling.
 */
final class XmlParser
{
    /**
     * Parse XML content to SimpleXMLElement.
     *
     * @param string $xml Raw XML content
     *
     * @throws ParseException If parsing fails
     *
     * @return SimpleXMLElement Parsed XML tree
     */
    public function parse(string $xml): SimpleXMLElement
    {
        // Normalize line endings
        $xml = str_replace(["\r\n", "\r"], "\n", $xml);

        // Ensure XML declaration if not present
        if (!str_starts_with(trim($xml), '<?xml')) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $xml;
        }

        libxml_use_internal_errors(true);
        $element = simplexml_load_string($xml, SimpleXMLElement::class, LIBXML_NOCDATA);

        if ($element === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();

            throw new ParseException('Failed to parse XML: ' . $this->formatErrors($errors));
        }

        return $element;
    }

    /**
     * Format libxml errors into a readable string.
     *
     * @param array<LibXMLError> $errors
     *
     * @return string Formatted error message
     */
    private function formatErrors(array $errors): string
    {
        $messages = [];
        foreach ($errors as $error) {
            $messages[] = \sprintf(
                '[Line %d] %s',
                $error->line,
                trim($error->message),
            );
        }

        return implode('; ', $messages);
    }
}
