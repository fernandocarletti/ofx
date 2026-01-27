<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Restriction types for open orders.
 *
 * Used in open order aggregates to specify order restrictions.
 */
enum Restriction: string
{
    /** All or none - order must be filled completely or not at all */
    case ALL_OR_NONE = 'ALLORNONE';

    /** Minimum units required for execution */
    case MINIMUM_UNITS = 'MINUNITS';

    /** No restrictions */
    case NONE = 'NONE';
}
