<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Loan payment frequency for 401(k) loans.
 *
 * Used in LOANINFO to specify the payment frequency.
 */
enum LoanPaymentFrequency: string
{
    case WEEKLY = 'WEEKLY';           // Weekly
    case BIWEEKLY = 'BIWEEKLY';       // Bi-weekly
    case TWICEMONTHLY = 'TWICEMONTHLY'; // Twice monthly
    case MONTHLY = 'MONTHLY';         // Monthly
    case FOURWEEKS = 'FOURWEEKS';     // Every four weeks
    case BIMONTHLY = 'BIMONTHLY';     // Bi-monthly
    case QUARTERLY = 'QUARTERLY';     // Quarterly
    case SEMIANNUALLY = 'SEMIANNUALLY'; // Semi-annually
    case ANNUALLY = 'ANNUALLY';       // Annually
    case OTHER = 'OTHER';             // Other
}
