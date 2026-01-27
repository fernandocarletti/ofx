<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Secured types for debt securities.
 *
 * Used in DEBTINFO to indicate the security backing type.
 */
enum SecuredType: string
{
    case NAKED = 'NAKED';       // Unsecured/Naked
    case COVERED = 'COVERED';   // Covered
}
