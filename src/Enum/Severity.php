<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Status severity levels for OFX responses.
 *
 * Used in STATUS aggregates to indicate the severity of error/success conditions.
 */
enum Severity: string
{
    /** Informational message */
    case INFO = 'INFO';

    /** Warning message */
    case WARNING = 'WARN';

    /** Error message */
    case ERROR = 'ERROR';
}
