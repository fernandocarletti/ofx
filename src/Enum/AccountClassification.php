<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Account classification types for investment accounts.
 *
 * Used in INVACCTINFO to specify the account classification.
 */
enum AccountClassification: string
{
    case PERSONAL = 'PERSONAL';     // Personal account
    case BUSINESS = 'BUSINESS';     // Business account
    case CORPORATE = 'CORPORATE';   // Corporate account
    case TRUST = 'TRUST';           // Trust account
}
