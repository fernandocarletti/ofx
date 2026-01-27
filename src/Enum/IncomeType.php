<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Income types for investment income transactions.
 *
 * Used in INCOME and REINVEST aggregates to specify the type of income.
 */
enum IncomeType: string
{
    /** Long-term capital gains */
    case CAPITAL_GAIN_LONG_TERM = 'CGLONG';

    /** Short-term capital gains */
    case CAPITAL_GAIN_SHORT_TERM = 'CGSHORT';

    /** Dividend */
    case DIVIDEND = 'DIV';

    /** Interest */
    case INTEREST = 'INTEREST';

    /** Miscellaneous income */
    case MISCELLANEOUS = 'MISC';
}
