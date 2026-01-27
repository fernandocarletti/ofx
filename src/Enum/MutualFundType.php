<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Mutual fund types.
 *
 * Used in MFINFO to specify the type of mutual fund.
 */
enum MutualFundType: string
{
    /** Open-end mutual fund */
    case OPEN_END = 'OPENEND';

    /** Closed-end mutual fund */
    case CLOSED_END = 'CLOSEEND';

    /** Other fund type */
    case OTHER = 'OTHER';
}
