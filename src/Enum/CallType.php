<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Call types for callable debt securities.
 *
 * Used in DEBTINFO to specify the type of call provision.
 */
enum CallType: string
{
    case CALL = 'CALL';       // Call
    case PUT = 'PUT';         // Put
    case PREFUND = 'PREFUND'; // Pre-refunded
    case MATURITY = 'MATURITY'; // Maturity
}
