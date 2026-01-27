<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Transfer action types for investment transfers.
 *
 * Used in TRANSFER aggregates to specify the direction of transfer.
 */
enum TransferAction: string
{
    case IN = 'IN';   // Transfer in
    case OUT = 'OUT'; // Transfer out
}
