<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Wire Destination Bank aggregate.
 *
 * Contains destination bank information for wire transfers.
 */
class WireDestBank extends Aggregate
{
    /**
     * Bank routing number (ABA/routing transit number).
     */
    public string $bankId;

    /**
     * Bank name.
     */
    public ?string $name = null;

    /**
     * Bank address line 1.
     */
    public ?string $address1 = null;

    /**
     * Bank address line 2.
     */
    public ?string $address2 = null;

    /**
     * Bank address line 3.
     */
    public ?string $address3 = null;

    /**
     * Bank city.
     */
    public ?string $city = null;

    /**
     * Bank state.
     */
    public ?string $state = null;

    /**
     * Bank postal code.
     */
    public ?string $postalCode = null;

    /**
     * Bank country.
     */
    public ?string $country = null;

    /**
     * Bank phone number.
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
            'BANKID' => 'bankId',
            'NAME' => 'name',
            'ADDR1' => 'address1',
            'ADDR2' => 'address2',
            'ADDR3' => 'address3',
            'CITY' => 'city',
            'STATE' => 'state',
            'POSTALCODE' => 'postalCode',
            'COUNTRY' => 'country',
            'PHONE' => 'phone',
        ];
    }
}
