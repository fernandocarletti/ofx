<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Foreign Account Tax Compliance aggregate.
 *
 * Foreign account and tax compliance information.
 */
class ForeignAccountTaxComp extends Aggregate
{
    /**
     * Foreign country name.
     */
    public ?string $foreignCountry = null;

    /**
     * Foreign tax paid amount (optional).
     */
    public ?string $foreignTaxPaid = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'FOREIGNCOUNTRY' => 'foreignCountry',
            'FOREIGNTAXPAID' => 'foreignTaxPaid',
        ];
    }
}
