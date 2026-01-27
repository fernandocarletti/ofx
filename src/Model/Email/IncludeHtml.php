<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use Ofx\Aggregate\Aggregate;

/**
 * Include HTML aggregate.
 *
 * Specifies whether to include HTML content in mail responses.
 */
class IncludeHtml extends Aggregate
{
    /**
     * Include HTML content (Y/N).
     */
    public ?bool $useHtml = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'USEHTML' => 'useHtml',
        ];
    }
}
