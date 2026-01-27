<?php

declare(strict_types=1);

namespace Ofx\Model\Signon;

use Ofx\Aggregate\Aggregate;

/**
 * Signon Messages Request V1 aggregate.
 *
 * Container for signon request messages.
 */
class SignonMessagesRequestV1 extends Aggregate
{
    /**
     * Signon request.
     */
    public ?SignonRequest $signonRequest = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SONRQ' => 'signonRequest',
        ];
    }
}
