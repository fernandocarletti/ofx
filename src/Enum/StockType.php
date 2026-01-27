<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Stock types.
 *
 * Used in STOCKINFO to specify the type of stock.
 */
enum StockType: string
{
    case COMMON = 'COMMON';       // Common stock
    case PREFERRED = 'PREFERRED'; // Preferred stock
    case CONVERTIBLE = 'CONVERTIBLE'; // Convertible
    case OTHER = 'OTHER';         // Other
}
