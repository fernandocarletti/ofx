<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099 Request aggregate.
 *
 * Request for tax 1099 information.
 */
class Tax1099Request extends Aggregate
{
    /**
     * Tax year for which 1099 data is requested (YYYY format).
     */
    public string $taxYear;

    /**
     * Recipient ID (optional).
     */
    public ?string $recipientId = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'TAXYEAR' => 'taxYear',
            'RECID' => 'recipientId',
        ];
    }
}
