<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Option sell types for option transactions.
 *
 * Used in SELLOPT aggregates to specify the type of option sell.
 */
enum OptionSellType: string
{
    case SELLTOOPEN = 'SELLTOOPEN';   // Sell to open
    case SELLTOCLOSE = 'SELLTOCLOSE'; // Sell to close
}
