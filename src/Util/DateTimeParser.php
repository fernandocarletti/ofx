<?php

declare(strict_types=1);

namespace Ofx\Util;

use DateTimeImmutable;
use DateTimeZone;
use Ofx\Exception\ValidationException;

/**
 * Utility for parsing OFX datetime formats.
 *
 * OFX datetime formats (per OFX spec section 3.2.8.2):
 * - YYYYMMDD (date only)
 * - YYYYMMDDHHMMSS (date and time)
 * - YYYYMMDDHHMMSS.XXX (with milliseconds)
 * - YYYYMMDDHHMMSS.XXX[offset:tzname] (with timezone)
 *
 * Examples:
 * - 20231215
 * - 20231215120000
 * - 20231215120000.000
 * - 20231215120000.000[-5:EST]
 * - 20231215120000.000[0:GMT]
 */
final class DateTimeParser
{
    /**
     * OFX datetime regex pattern.
     */
    private const PATTERN = '/^
        (?<year>\d{4})
        (?<month>0[1-9]|1[0-2])
        (?<day>0[1-9]|[12]\d|3[01])
        (?:
            (?<hour>[01]\d|2[0-3])
            (?<minute>[0-5]\d)
            (?<second>[0-5]\d|60)
            (?:\.(?<ms>\d{3}))?
            (?:\[
                (?<offset>[+-]?\d+(?:\.\d+)?)
                (?::(?<tzname>[^\]]+))?
            \])?
        )?
    $/x';

    /**
     * Common timezone abbreviation mappings to UTC offset in hours.
     *
     * @var array<string, int>
     */
    private const TZ_MAP = [
        'EST' => -5,
        'EDT' => -4,
        'CST' => -6,
        'CDT' => -5,
        'MST' => -7,
        'MDT' => -6,
        'PST' => -8,
        'PDT' => -7,
        'AKST' => -9,
        'AKDT' => -8,
        'HST' => -10,
        'GMT' => 0,
        'UTC' => 0,
        'BST' => 1,
        'CET' => 1,
        'CEST' => 2,
        'EET' => 2,
        'EEST' => 3,
        'JST' => 9,
        'AEST' => 10,
        'AEDT' => 11,
    ];

    /**
     * Parse OFX datetime string.
     *
     * @param string $value OFX datetime string
     *
     * @throws ValidationException If format is invalid or date is not valid
     *
     * @return DateTimeImmutable Parsed datetime (normalized to UTC)
     */
    public static function parse(string $value): DateTimeImmutable
    {
        $value = trim($value);

        if (!preg_match(self::PATTERN, $value, $m)) {
            throw new ValidationException("Invalid OFX datetime format: '$value'");
        }

        $year = (int) $m['year'];
        $month = (int) $m['month'];
        $day = (int) $m['day'];
        $hour = isset($m['hour']) && $m['hour'] !== '' ? (int) $m['hour'] : 0;
        $minute = isset($m['minute']) && $m['minute'] !== '' ? (int) $m['minute'] : 0;
        $second = isset($m['second']) && $m['second'] !== '' ? (int) $m['second'] : 0;
        $microsecond = isset($m['ms']) && $m['ms'] !== '' ? (int) $m['ms'] * 1000 : 0;

        // Strict validation: check that the date is valid for the given month/year
        // This catches invalid dates like Feb 30, Feb 29 in non-leap years, etc.
        if (!checkdate($month, $day, $year)) {
            throw new ValidationException("Invalid calendar date: '$value'");
        }

        // Calculate timezone offset
        $offsetHours = 0.0;

        if (!empty($m['offset'])) {
            // Offset can be fractional like -5.30 for -5:30
            $offsetHours = (float) $m['offset'];
        } elseif (!empty($m['tzname']) && isset(self::TZ_MAP[$m['tzname']])) {
            $offsetHours = (float) self::TZ_MAP[$m['tzname']];
        }

        // Convert fractional hours to total seconds
        // OFX uses format like [5.30] meaning 5 hours 30 minutes
        // For negative offsets like [-3.30], the sign applies to the whole offset
        $sign = $offsetHours >= 0 ? 1 : -1;
        $absOffset = abs($offsetHours);
        $wholeHours = (int) $absOffset;
        $fractionalPart = $absOffset - $wholeHours;

        // The fractional part in OFX is actually minutes (e.g., .30 = 30 minutes)
        $offsetMinutes = (int) round($fractionalPart * 100);

        $totalOffsetSeconds = $sign * (($wholeHours * 3600) + ($offsetMinutes * 60));

        // Create timezone string
        $sign = $totalOffsetSeconds >= 0 ? '+' : '-';
        $absOffset = abs($totalOffsetSeconds);
        $tzHours = intdiv($absOffset, 3600);
        $tzMins = intdiv($absOffset % 3600, 60);
        $tzString = \sprintf('%s%02d:%02d', $sign, $tzHours, $tzMins);

        // Create datetime string in ISO format
        $dateString = \sprintf(
            '%04d-%02d-%02dT%02d:%02d:%02d.%06d%s',
            $year,
            $month,
            $day,
            $hour,
            $minute,
            $second,
            $microsecond,
            $tzString,
        );

        $dt = DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.uP', $dateString);

        if ($dt === false) {
            throw new ValidationException("Failed to parse datetime: '$value'");
        }

        // Normalize to UTC
        return $dt->setTimezone(new DateTimeZone('UTC'));
    }

    /**
     * Parse OFX time-only string.
     *
     * @param string $value OFX time string (HHMMSS.XXX[offset:tzname])
     *
     * @throws ValidationException If format is invalid
     *
     * @return DateTimeImmutable Parsed time (with arbitrary date, normalized to UTC)
     */
    public static function parseTime(string $value): DateTimeImmutable
    {
        // Prepend a dummy date to use the main parser
        return self::parse('19990101' . trim($value));
    }
}
