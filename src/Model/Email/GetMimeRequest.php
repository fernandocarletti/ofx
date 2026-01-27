<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use Ofx\Aggregate\Aggregate;

/**
 * Get MIME Request aggregate.
 *
 * Request to retrieve MIME content.
 */
class GetMimeRequest extends Aggregate
{
    /**
     * URL of the MIME content to retrieve.
     */
    public string $url;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'URL' => 'url',
        ];
    }
}
