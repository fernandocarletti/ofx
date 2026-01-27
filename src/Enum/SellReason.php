<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Sell reasons for investment transactions.
 *
 * Used in SELLMF aggregates to specify the reason for the sale.
 */
enum SellReason: string
{
    case CALL = 'CALL';         // Call (for debt)
    case SELL = 'SELL';         // Sell
    case MATURITY = 'MATURITY'; // Maturity
}
