<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * 401(k) source types for investment transactions.
 *
 * Used in 401(k) transactions to identify the source of funds.
 */
enum Investment401kSource: string
{
    /** Pre-tax contributions */
    case PRE_TAX = 'PRETAX';

    /** After-tax contributions */
    case AFTER_TAX = 'AFTERTAX';

    /** Employer match */
    case MATCH = 'MATCH';

    /** Profit sharing */
    case PROFIT_SHARING = 'PROFITSHARING';

    /** Rollover */
    case ROLLOVER = 'ROLLOVER';

    /** Other vested funds */
    case OTHER_VESTED = 'OTHERVEST';

    /** Other non-vested funds */
    case OTHER_NON_VESTED = 'OTHERNONVEST';
}
