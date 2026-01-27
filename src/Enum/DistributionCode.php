<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Distribution code enum for 1099-R retirement distributions.
 *
 * Used in TAX1099R aggregates to specify the type of distribution.
 */
enum DistributionCode: string
{
    /** Early distribution, no known exception */
    case EARLY_NO_EXCEPTION = '1';

    /** Early distribution, exception applies */
    case EARLY_EXCEPTION = '2';

    /** Disability */
    case DISABILITY = '3';

    /** Death */
    case DEATH = '4';

    /** Prohibited transaction */
    case PROHIBITED = '5';

    /** Section 1035 exchange */
    case EXCHANGE_1035 = '6';

    /** Normal distribution */
    case NORMAL = '7';

    /** Excess contributions plus earnings/excess deferrals taxable in prior year */
    case EXCESS_PRIOR = '8';

    /** Cost of current life insurance protection */
    case LIFE_INSURANCE = '9';

    /** Excess contributions plus earnings/excess deferrals taxable in current year */
    case EXCESS_CURRENT = 'A';

    /** Designated Roth account distribution */
    case ROTH = 'B';

    /** Reportable death benefits under section 6050Y */
    case DEATH_BENEFITS = 'C';

    /** Excess annual additions under section 415 */
    case EXCESS_415 = 'D';

    /** Excess annual additions under section 415, prior year */
    case EXCESS_415_PRIOR = 'E';

    /** Charitable gift annuity */
    case CHARITABLE = 'F';

    /** Direct rollover to qualified plan, 403(b), governmental 457(b), or IRA */
    case ROLLOVER_QUALIFIED = 'G';

    /** Direct rollover to Roth IRA */
    case ROLLOVER_ROTH = 'H';

    /** Premiums paid by trustee for accident or health insurance */
    case PREMIUMS = 'J';

    /** Distribution of traditional IRA assets not having RLE */
    case IRA_NO_RLE = 'K';

    /** Loans treated as distributions */
    case LOAN_DISTRIBUTION = 'L';

    /** Qualified plan loan offset */
    case LOAN_OFFSET = 'M';

    /** Recharacterized IRA contribution for prior year */
    case RECHARACTERIZED_PRIOR = 'N';

    /** Recharacterized IRA contribution for current year */
    case RECHARACTERIZED_CURRENT = 'P';

    /** Qualified distribution from Roth IRA */
    case ROTH_QUALIFIED = 'Q';

    /** Recharacterized Roth IRA conversion */
    case ROTH_RECHARACTERIZED = 'R';

    /** Early distribution from SIMPLE IRA in first 2 years, no known exception */
    case SIMPLE_EARLY_NO_EXCEPTION = 'S';

    /** Roth IRA distribution, exception applies */
    case ROTH_EXCEPTION = 'T';

    /** Dividend distribution from ESOP */
    case ESOP_DIVIDEND = 'U';

    /** Inherited IRA - nonspouse beneficiary */
    case INHERITED_NONSPOUSE = 'W';
}
