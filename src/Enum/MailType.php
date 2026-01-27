<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Mail type enum for email messages.
 *
 * Used in MAIL aggregates to specify recipient type.
 */
enum MailType: string
{
    /** Primary recipient */
    case TO = 'TO';

    /** Carbon copy recipient */
    case CC = 'CC';

    /** Blind carbon copy recipient */
    case BCC = 'BCC';
}
