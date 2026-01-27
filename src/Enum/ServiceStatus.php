<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Service status for account services.
 *
 * Used to indicate the current status of a financial service.
 */
enum ServiceStatus: string
{
    /** Service is available for use */
    case AVAILABLE = 'AVAIL';

    /** Service is pending activation */
    case PENDING_ACTIVATION = 'PEND';

    /** Service is currently active */
    case ACTIVE = 'ACTIVE';
}
