<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Buy types for investment transactions.
 *
 * Used in INVBUY aggregates to specify the type of buy transaction.
 */
enum BuyType: string
{
    case BUY = 'BUY';         // Buy
    case BUYTOCOVER = 'BUYTOCOVER'; // Buy to cover short sale
}
