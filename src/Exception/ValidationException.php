<?php

declare(strict_types=1);

namespace Ofx\Exception;

/**
 * Exception thrown when OFX content violates the specification.
 *
 * This exception is raised for:
 * - Missing required fields
 * - Invalid enum values
 * - Type conversion failures
 * - Constraint violations (e.g., string length, mutual exclusions)
 * - Unknown tags (in strict mode)
 */
final class ValidationException extends OfxException {}
