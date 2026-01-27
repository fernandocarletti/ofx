<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;

/**
 * Payee aggregate.
 *
 * Contains payee information for a transaction.
 */
class Payee extends Aggregate
{
    /**
     * Payee name.
     */
    public string $name;

    /**
     * Address line 1.
     */
    public ?string $addr1 = null;

    /**
     * Address line 2 (optional).
     */
    public ?string $addr2 = null;

    /**
     * Address line 3 (optional).
     */
    public ?string $addr3 = null;

    /**
     * City.
     */
    public ?string $city = null;

    /**
     * State or province.
     */
    public ?string $state = null;

    /**
     * Postal code.
     */
    public ?string $postalcode = null;

    /**
     * Country.
     */
    public ?string $country = null;

    /**
     * Phone number.
     */
    public ?string $phone = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'NAME' => 'name',
            'ADDR1' => 'addr1',
            'ADDR2' => 'addr2',
            'ADDR3' => 'addr3',
            'CITY' => 'city',
            'STATE' => 'state',
            'POSTALCODE' => 'postalcode',
            'COUNTRY' => 'country',
            'PHONE' => 'phone',
        ];
    }
}
