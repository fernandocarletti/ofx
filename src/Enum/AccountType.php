<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Bank account types.
 *
 * Used to specify the type of bank account in BANKACCTFROM/BANKACCTTO aggregates.
 */
enum AccountType: string
{
    /** Checking account */
    case CHECKING = 'CHECKING';

    /** Savings account */
    case SAVINGS = 'SAVINGS';

    /** Money market account */
    case MONEY_MARKET = 'MONEYMRKT';

    /** Line of credit */
    case CREDIT_LINE = 'CREDITLINE';

    /** Certificate of deposit */
    case CERTIFICATE_OF_DEPOSIT = 'CD';
}
