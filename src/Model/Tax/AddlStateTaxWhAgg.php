<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Additional State Tax Withholding Aggregate.
 *
 * Additional state tax withholding information for multiple states.
 */
class AddlStateTaxWhAgg extends Aggregate
{
    /**
     * State code (2-character abbreviation).
     */
    public string $stateCode;

    /**
     * State ID number (optional).
     */
    public ?string $stateIdNumber = null;

    /**
     * State tax withheld amount (optional).
     */
    public ?string $stateTaxWithheld = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'STATECODE' => 'stateCode',
            'STATEIDNUM' => 'stateIdNumber',
            'STATETAXWH' => 'stateTaxWithheld',
        ];
    }
}
