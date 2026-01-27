<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Recipient Address aggregate.
 *
 * Address information for the recipient on tax forms.
 */
class RecipientAddress extends Aggregate
{
    /**
     * Recipient name line 1.
     */
    public string $recipientName1;

    /**
     * Recipient name line 2 (optional).
     */
    public ?string $recipientName2 = null;

    /**
     * Address line 1.
     */
    public string $addressLine1;

    /**
     * Address line 2 (optional).
     */
    public ?string $addressLine2 = null;

    /**
     * Address line 3 (optional).
     */
    public ?string $addressLine3 = null;

    /**
     * City.
     */
    public string $city;

    /**
     * State or province.
     */
    public string $state;

    /**
     * Postal code.
     */
    public string $postalCode;

    /**
     * Phone number (optional).
     */
    public ?string $phone = null;

    /**
     * Country (optional).
     */
    public ?string $country = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'RECNAME1' => 'recipientName1',
            'RECNAME2' => 'recipientName2',
            'ADDR1' => 'addressLine1',
            'ADDR2' => 'addressLine2',
            'ADDR3' => 'addressLine3',
            'CITY' => 'city',
            'STATE' => 'state',
            'POSTALCODE' => 'postalCode',
            'PHONE' => 'phone',
            'COUNTRY' => 'country',
        ];
    }
}
