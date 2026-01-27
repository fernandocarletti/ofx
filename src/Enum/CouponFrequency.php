<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Coupon frequency for debt securities.
 *
 * Used in DEBTINFO to specify how often coupon payments are made.
 */
enum CouponFrequency: string
{
    case MONTHLY = 'MONTHLY';       // Monthly
    case QUARTERLY = 'QUARTERLY';   // Quarterly
    case SEMIANNUAL = 'SEMIANNUAL'; // Semi-annual
    case ANNUAL = 'ANNUAL';         // Annual
    case OTHER = 'OTHER';           // Other
}
