<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Asset class types for investment positions.
 *
 * Used to categorize investments by asset class.
 */
enum AssetClass: string
{
    /** Domestic bond */
    case DOMESTIC_BOND = 'DOMESTICBOND';

    /** International bond */
    case INTERNATIONAL_BOND = 'INTLBOND';

    /** Large cap stock */
    case LARGE_STOCK = 'LARGESTOCK';

    /** Small cap stock */
    case SMALL_STOCK = 'SMALLSTOCK';

    /** International stock */
    case INTERNATIONAL_STOCK = 'INTLSTOCK';

    /** Money market */
    case MONEY_MARKET = 'MONEYMRKT';

    /** Other asset class */
    case OTHER = 'OTHER';
}
