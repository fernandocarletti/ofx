<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Unit types for open orders.
 *
 * Used in open order aggregates to specify order unit type.
 */
enum UnitType: string
{
    case SHARES = 'SHARES';     // Shares
    case DEBT = 'DEBT';         // Debt
    case CURRENCY = 'CURRENCY'; // Currency
    case OTHER = 'OTHER';       // Other
}
