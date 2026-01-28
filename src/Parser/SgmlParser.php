<?php

declare(strict_types=1);

namespace Ofx\Parser;

use LibXMLError;
use Ofx\Exception\ParseException;
use SimpleXMLElement;

/**
 * Parser for OFX v1 SGML format.
 *
 * Converts SGML (with optional closing tags) to well-formed XML
 * that can be processed by SimpleXML.
 *
 * OFXv1 SGML has these characteristics:
 * - Closing tags are optional for data elements
 * - Tags are always uppercase
 * - Data elements cannot contain child elements
 * - Aggregate elements contain only other elements (no text)
 */
final class SgmlParser
{
    /**
     * Regex pattern to match OFX SGML tags and content.
     *
     * Captures:
     * - tag: The tag name (may start with / for closing tags)
     * - cdata: CDATA content if present
     * - text: Text content if present
     * - closetag: Closing tag if present
     */
    private const PATTERN = '/<(?<tag>\/?)([A-Z0-9._]+)>(?:(?:<!\[CDATA\[(?<cdata>.*?)\]\]>)|(?<text>[^<]*))?/s';

    /**
     * Parse SGML content to SimpleXMLElement.
     *
     * @param string $sgml Raw SGML content
     *
     * @throws ParseException If parsing fails
     *
     * @return SimpleXMLElement Parsed XML tree
     */
    public function parse(string $sgml): SimpleXMLElement
    {
        $xml = $this->convertToXml($sgml);

        libxml_use_internal_errors(true);
        $element = simplexml_load_string($xml, SimpleXMLElement::class, LIBXML_NOCDATA);

        if ($element === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();

            throw new ParseException('Failed to parse SGML: ' . $this->formatErrors($errors));
        }

        return $element;
    }

    /**
     * Convert SGML to well-formed XML.
     *
     * @param string $sgml Raw SGML content
     *
     * @throws ParseException If SGML is malformed
     *
     * @return string Well-formed XML
     */
    private function convertToXml(string $sgml): string
    {
        // Normalize line endings
        $sgml = str_replace(["\r\n", "\r"], "\n", $sgml);

        $result = '';
        $stack = [];
        $offset = 0;

        while (preg_match(self::PATTERN, $sgml, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $fullMatch = $match[0][0];
            $matchStart = $match[0][1];

            // Check for text between tags (should only be whitespace)
            if ($matchStart > $offset) {
                $between = substr($sgml, $offset, $matchStart - $offset);
                $trimmed = trim($between);
                if ($trimmed !== '') {
                    throw new ParseException("Unexpected text between tags: '$trimmed'");
                }
            }

            $isClosing = $match[1][0] === '/';
            $tagName = $match[2][0];
            $cdata = isset($match['cdata']) && $match['cdata'][1] !== -1 ? $match['cdata'][0] : null;
            $text = isset($match['text']) && $match['text'][1] !== -1 ? $match['text'][0] : null;

            if ($isClosing) {
                // Explicit closing tag - close all tags up to and including this one
                $result .= $this->closeTagsUntil($stack, $tagName);
            } else {
                // Opening tag
                $result .= '<' . $tagName . '>';

                $content = $cdata ?? $text;
                $trimmedContent = $content !== null ? trim($content) : '';

                if ($trimmedContent !== '') {
                    // Data element - has text content, self-close
                    $result .= $this->escapeXml($trimmedContent);
                    $result .= '</' . $tagName . '>';
                } else {
                    // Aggregate element - push to stack
                    $stack[] = $tagName;
                }
            }

            $offset = $matchStart + \strlen($fullMatch);
        }

        // Close any remaining open tags
        while ($tag = array_pop($stack)) {
            $result .= '</' . $tag . '>';
        }

        return $result;
    }

    /**
     * Close tags until we reach the target tag.
     *
     * In OFX SGML, closing tags are optional for data elements. When a data element
     * has content (e.g., `<CODE>0`), we auto-close it immediately. However, some banks
     * (like Nubank) include explicit closing tags (e.g., `<CODE>0</CODE>`).
     *
     * If the target tag is not found in the stack, it means the element was already
     * auto-closed as a data element, so we simply ignore the redundant closing tag.
     *
     * @param array<string> $stack Tag stack (modified in place)
     * @param string $targetTag Tag to close up to
     *
     * @return string Closing tags XML
     */
    private function closeTagsUntil(array &$stack, string $targetTag): string
    {
        $result = '';

        // Check if target tag exists in stack
        if (!in_array($targetTag, $stack, true)) {
            // Tag not in stack - it was already auto-closed as a data element
            // This happens when banks include explicit closing tags like </CODE>
            // after data elements that were already closed. Simply ignore it.
            return '';
        }

        while ($tag = array_pop($stack)) {
            $result .= '</' . $tag . '>';
            if ($tag === $targetTag) {
                break;
            }
        }

        return $result;
    }

    /**
     * Escape text for XML.
     *
     * @param string $text Raw text
     *
     * @return string XML-escaped text
     */
    private function escapeXml(string $text): string
    {
        return htmlspecialchars($text, ENT_XML1 | ENT_QUOTES, 'UTF-8', false);
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
