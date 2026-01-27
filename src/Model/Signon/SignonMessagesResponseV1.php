<?php

declare(strict_types=1);

namespace Ofx\Model\Signon;

use Ofx\Aggregate\Aggregate;

/**
 * Signon Messages Response V1 aggregate.
 *
 * Container for signon response messages.
 */
class SignonMessagesResponseV1 extends Aggregate
{
    /**
     * Signon response.
     */
    public ?SignonResponse $signonResponse = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SONRS' => 'signonResponse',
        ];
    }
}
