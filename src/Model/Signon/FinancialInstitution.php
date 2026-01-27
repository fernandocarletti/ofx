<?php

declare(strict_types=1);

namespace Ofx\Model\Signon;

use Ofx\Aggregate\Aggregate;

/**
 * Financial Institution aggregate.
 *
 * Contains FI identification information.
 */
class FinancialInstitution extends Aggregate
{
    /**
     * Financial institution organization name.
     */
    public ?string $organization = null;

    /**
     * Financial institution ID.
     */
    public ?string $financialInstitutionId = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'ORG' => 'organization',
            'FID' => 'financialInstitutionId',
        ];
    }
}
