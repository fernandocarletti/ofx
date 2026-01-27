<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Related option transaction types for CLOSUREOPT.
 *
 * Used in CLOSUREOPT to specify the relationship type.
 */
enum RelatedOptionType: string
{
    case SPREAD = 'SPREAD';     // Spread
    case STRADDLE = 'STRADDLE'; // Straddle
    case NONE = 'NONE';         // None
    case OTHER = 'OTHER';       // Other
}
