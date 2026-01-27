<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Position types for investment positions.
 *
 * Used to indicate whether a position is long or short.
 */
enum PositionType: string
{
    case LONG = 'LONG';   // Long position
    case SHORT = 'SHORT'; // Short position
}
