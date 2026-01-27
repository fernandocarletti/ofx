<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Unique ID types for securities.
 *
 * Used in SECID aggregates to specify the type of unique identifier.
 */
enum UniqueIdType: string
{
    case CUSIP = 'CUSIP';     // CUSIP (North American)
    case ISIN = 'ISIN';       // ISIN (International)
    case SEDOL = 'SEDOL';     // SEDOL (UK)
    case VALOR = 'VALOR';     // Valor (Switzerland)
    case WKN = 'WKN';         // WKN (Germany)
    case OTHER = 'OTHER';     // Other
}
