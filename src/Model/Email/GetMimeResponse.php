<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use Ofx\Aggregate\Aggregate;

/**
 * Get MIME Response aggregate.
 *
 * Response containing MIME content.
 */
class GetMimeResponse extends Aggregate
{
    /**
     * URL of the MIME content.
     */
    public ?string $url = null;

    /**
     * MIME content (base64 encoded).
     */
    public ?string $mimeContent = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'URL' => 'url',
            'MIMECONTENT' => 'mimeContent',
        ];
    }
}
