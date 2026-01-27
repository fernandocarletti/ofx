<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Payment processing status types.
 *
 * Used in PMTPRCSTS to indicate the status of payment processing.
 */
enum PaymentProcessingStatus: string
{
    /** Will process on specified date */
    case WILL_PROCESS = 'WILLPROCESSON';

    /** Processed on specified date */
    case PROCESSED = 'PROCESSEDON';

    /** No funds available on specified date */
    case NO_FUNDS = 'NOFUNDSON';

    /** Cancelled on specified date */
    case CANCELLED = 'CANCELEDON';

    /** Failed on specified date */
    case FAILED = 'FAILEDON';
}
