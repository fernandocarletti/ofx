<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * State Tax Information aggregate.
 *
 * State-specific tax withholding information.
 */
class StateInfo extends Aggregate
{
    /**
     * State code (2-character abbreviation).
     */
    public string $stateCode;

    /**
     * Employer's state ID number (optional).
     */
    public ?string $employerStateId = null;

    /**
     * State tax withheld amount (optional).
     */
    public ?string $stateTaxWithheld = null;

    /**
     * State distribution amount (optional).
     */
    public ?string $stateIdDistribution = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'STATECODE' => 'stateCode',
            'EMPLOYERSTID' => 'employerStateId',
            'STATETAXWH' => 'stateTaxWithheld',
            'STATEIDDISTR' => 'stateIdDistribution',
        ];
    }
}
