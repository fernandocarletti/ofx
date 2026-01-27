<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Payer Address aggregate.
 *
 * Address information for the payer on tax forms.
 */
class PayerAddress extends Aggregate
{
    /**
     * Payer name line 1.
     */
    public string $payerName1;

    /**
     * Payer name line 2 (optional).
     */
    public ?string $payerName2 = null;

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
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'PAYERNAME1' => 'payerName1',
            'PAYERNAME2' => 'payerName2',
            'ADDR1' => 'addressLine1',
            'ADDR2' => 'addressLine2',
            'ADDR3' => 'addressLine3',
            'CITY' => 'city',
            'STATE' => 'state',
            'POSTALCODE' => 'postalCode',
            'PHONE' => 'phone',
        ];
    }
}
