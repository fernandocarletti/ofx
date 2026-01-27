<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Payer ID aggregate.
 *
 * Identification information for the payer on tax forms.
 */
class PayerId extends Aggregate
{
    /**
     * Federal Employer Identification Number (EIN).
     */
    public string $employerIdentificationNumber;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'EIN' => 'employerIdentificationNumber',
        ];
    }
}
