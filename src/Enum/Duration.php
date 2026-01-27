<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Duration types for open orders.
 *
 * Used in open order aggregates to specify order duration.
 */
enum Duration: string
{
    /** Day order - expires at end of trading day */
    case DAY = 'DAY';

    /** Good until cancelled - remains active until filled or cancelled */
    case GOOD_UNTIL_CANCELLED = 'GOODTILCANCEL';

    /** Immediate or cancel - must be filled immediately or cancelled */
    case IMMEDIATE = 'IMMEDIATE';
}
