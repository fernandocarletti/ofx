<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Transfer status code enum for interbank and wire transfers.
 *
 * Used in transfer processing status aggregates.
 */
enum TransferStatusCode: string
{
    /** Transfer is pending and will process on specified date */
    case WILL_PROCESS = 'WILLPROCESSON';

    /** Transfer has been posted */
    case POSTED = 'POSTEDON';

    /** Transfer cannot be processed due to insufficient funds */
    case NO_FUNDS = 'NOFUNDSON';

    /** Transfer was cancelled */
    case CANCELLED = 'CANCELLEDON';

    /** Transfer failed */
    case FAILED = 'FAILEDON';
}
