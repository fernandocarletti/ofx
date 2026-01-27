<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Debt types for debt securities.
 *
 * Used in DEBTINFO to specify the type of debt instrument.
 */
enum DebtType: string
{
    case COUPON = 'COUPON';   // Coupon debt
    case ZERO = 'ZERO';       // Zero coupon debt
}
