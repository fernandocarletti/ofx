<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Correction action types for investment transactions.
 *
 * Used to indicate whether a transaction is a correction and the type of correction.
 */
enum CorrectAction: string
{
    case DELETE = 'DELETE';   // Delete the corrected transaction
    case REPLACE = 'REPLACE'; // Replace the corrected transaction
}
