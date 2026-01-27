<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Option buy types for option transactions.
 *
 * Used in BUYOPT aggregates to specify the type of option buy.
 */
enum OptionBuyType: string
{
    case BUYTOOPEN = 'BUYTOOPEN';   // Buy to open
    case BUYTOCLOSE = 'BUYTOCLOSE'; // Buy to close
}
