<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Usage types for bank accounts.
 *
 * Used in BANKACCTINFO to specify the account usage type.
 */
enum UsageType: string
{
    /** Checking account */
    case CHECKING = 'CHECKING';

    /** Savings account */
    case SAVINGS = 'SAVINGS';

    /** Money market account */
    case MONEY_MARKET = 'MONEYMRKT';

    /** Credit line */
    case CREDIT_LINE = 'CREDITLINE';
}
