<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Cost basis type enum for 1099-B broker transactions.
 *
 * Used in TAX1099B aggregates to specify the type of cost basis reporting.
 */
enum BasisType: string
{
    /** Short-term, basis reported to IRS */
    case SHORT_TERM_REPORTED = 'A';

    /** Short-term, basis not reported to IRS */
    case SHORT_TERM_NOT_REPORTED = 'B';

    /** Long-term, basis reported to IRS */
    case LONG_TERM_REPORTED = 'D';

    /** Long-term, basis not reported to IRS */
    case LONG_TERM_NOT_REPORTED = 'E';

    /** Undetermined holding period, basis reported to IRS */
    case UNDETERMINED_REPORTED = 'X';

    /** Undetermined holding period, basis not reported to IRS */
    case UNDETERMINED_NOT_REPORTED = 'Y';
}
