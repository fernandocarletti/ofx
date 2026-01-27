<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * FI Portion aggregate.
 *
 * Represents a portion of a mutual fund's asset allocation
 * using FI-defined asset classes.
 */
class FiPortion extends Aggregate
{
    /**
     * FI-defined asset class.
     */
    public string $financialInstitutionAssetClass;

    /**
     * Percentage of fund in this asset class.
     */
    public string $percent;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'FIASSETCLASS' => 'financialInstitutionAssetClass',
            'PERCENT' => 'percent',
        ];
    }
}
