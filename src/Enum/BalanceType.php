<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Balance types for BAL aggregates.
 *
 * Used to specify the type of balance (dollar or percentage).
 */
enum BalanceType: string
{
    case DOLLAR = 'DOLLAR';   // Dollar amount
    case PERCENT = 'PERCENT'; // Percentage
    case NUMBER = 'NUMBER';   // Number
}
