<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Option types (call or put).
 *
 * Used in OPTINFO to specify the type of option contract.
 */
enum OptionType: string
{
    case CALL = 'CALL'; // Call option
    case PUT = 'PUT';   // Put option
}
