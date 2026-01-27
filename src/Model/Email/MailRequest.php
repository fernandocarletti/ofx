<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use Ofx\Aggregate\Aggregate;

/**
 * Mail Request aggregate.
 *
 * Request to send or retrieve mail.
 */
class MailRequest extends Aggregate
{
    /**
     * Mail content.
     */
    public Mail $mail;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'MAIL' => 'mail',
        ];
    }
}
