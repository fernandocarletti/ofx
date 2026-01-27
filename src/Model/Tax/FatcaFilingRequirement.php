<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * FATCA Filing Requirement aggregate.
 *
 * Foreign Account Tax Compliance Act (FATCA) filing requirement.
 */
class FatcaFilingRequirement extends Aggregate
{
    /**
     * FATCA filing required indicator.
     */
    public bool $fatcaRequired;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'FATCAREQ' => 'fatcaRequired',
        ];
    }
}
