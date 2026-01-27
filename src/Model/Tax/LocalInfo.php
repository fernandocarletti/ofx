<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Local Tax Information aggregate.
 *
 * Local/municipal tax withholding information.
 */
class LocalInfo extends Aggregate
{
    /**
     * Locality name.
     */
    public string $localityName;

    /**
     * Local tax withheld amount (optional).
     */
    public ?string $localTaxWithheld = null;

    /**
     * Local distribution amount (optional).
     */
    public ?string $localDistribution = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'LOCALNAME' => 'localityName',
            'LOCALTAXWH' => 'localTaxWithheld',
            'LOCALDISTR' => 'localDistribution',
        ];
    }
}
