<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Sell types for investment transactions.
 *
 * Used in INVSELL aggregates to specify the type of sell transaction.
 */
enum SellType: string
{
    case SELL = 'SELL';         // Sell
    case SELLSHORT = 'SELLSHORT'; // Sell short
}
