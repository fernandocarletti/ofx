<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Payee type enum for bill payment.
 *
 * Used in payee aggregates to specify the type of payee.
 */
enum PayeeType: string
{
    /** Individual person */
    case INDIVIDUAL = 'INDIVIDUAL';

    /** Business entity */
    case BUSINESS = 'BUSINESS';

    /** Government entity */
    case GOVERNMENT = 'GOVERNMENT';
}
