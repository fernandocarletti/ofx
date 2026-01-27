<?php

declare(strict_types=1);

namespace Ofx\Element;

use DateTimeImmutable;
use Ofx\Exception\ValidationException;
use Ofx\Util\DateTimeParser;

/**
 * OFX DateTime element.
 *
 * Supported formats (per OFX spec section 3.2.8.2):
 * - YYYYMMDD
 * - YYYYMMDDHHMMSS
 * - YYYYMMDDHHMMSS.XXX
 * - YYYYMMDDHHMMSS.XXX[offset:tzname]
 *
 * All values are normalized to UTC.
 */
final class DateTimeElement extends Element
{
    /**
     * Convert OFX datetime string to DateTimeImmutable.
     *
     * @param string|null $value Raw OFX datetime value
     *
     * @throws ValidationException If format is invalid
     *
     * @return DateTimeImmutable|null Parsed datetime (normalized to UTC)
     */
    public function convert(?string $value): ?DateTimeImmutable
    {
        $this->enforceRequired($value);

        if ($value === null || $value === '') {
            return null;
        }

        return DateTimeParser::parse($value);
    }
}
