<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Debt class types for debt securities.
 *
 * Used in DEBTINFO to specify the class of debt instrument.
 */
enum DebtClass: string
{
    case TREASURY = 'TREASURY';   // Treasury debt
    case MUNICIPAL = 'MUNICIPAL'; // Municipal debt
    case CORPORATE = 'CORPORATE'; // Corporate debt
    case OTHER = 'OTHER';         // Other debt
}
