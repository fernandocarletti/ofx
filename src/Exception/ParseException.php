<?php

declare(strict_types=1);

namespace Ofx\Exception;

/**
 * Exception thrown when parsing OFX content fails.
 *
 * This exception is raised for syntax errors in the OFX document,
 * malformed headers, or invalid SGML/XML structure.
 */
final class ParseException extends OfxException {}
