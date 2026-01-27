<?php

declare(strict_types=1);

namespace Ofx\Element;

use DateTimeImmutable;
use Ofx\Exception\ValidationException;
use Ofx\Util\DateTimeParser;

/**
 * OFX Time element (time only, no date).
 *
 * Supported formats (per OFX spec section 3.2.8.3):
 * - HHMMSS
 * - HHMMSS.XXX
 * - HHMMSS.XXX[offset:tzname]
 *
 * Returns a DateTimeImmutable with an arbitrary date component.
 * All values are normalized to UTC.
 */
final class TimeElement extends Element
{
    /**
     * Convert OFX time string to DateTimeImmutable.
     *
     * @param string|null $value Raw OFX time value
     *
     * @throws ValidationException If format is invalid
     *
     * @return DateTimeImmutable|null Parsed time (normalized to UTC)
     */
    public function convert(?string $value): ?DateTimeImmutable
    {
        $this->enforceRequired($value);

        if ($value === null || $value === '') {
            return null;
        }

        return DateTimeParser::parseTime($value);
    }
}
