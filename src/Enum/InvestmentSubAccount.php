<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Investment sub-account types.
 *
 * Used to specify which sub-account a transaction or position belongs to.
 */
enum InvestmentSubAccount: string
{
    case CASH = 'CASH';     // Cash sub-account
    case MARGIN = 'MARGIN'; // Margin sub-account
    case SHORT = 'SHORT';   // Short sub-account
    case OTHER = 'OTHER';   // Other sub-account
}
