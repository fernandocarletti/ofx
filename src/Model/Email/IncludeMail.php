<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Include Mail aggregate.
 *
 * Specifies which mail messages to include in a request.
 */
class IncludeMail extends Aggregate
{
    /**
     * Include mail from this date.
     */
    public ?DateTimeImmutable $startDate = null;

    /**
     * Include mail to this date.
     */
    public ?DateTimeImmutable $endDate = null;

    /**
     * Include images (Y/N).
     */
    public ?bool $includeImages = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DTSTART' => 'startDate',
            'DTEND' => 'endDate',
            'INCLIMAGES' => 'includeImages',
        ];
    }
}
