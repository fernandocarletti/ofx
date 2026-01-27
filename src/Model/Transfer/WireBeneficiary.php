<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Wire Beneficiary aggregate.
 *
 * Contains beneficiary information for wire transfers.
 */
class WireBeneficiary extends Aggregate
{
    /**
     * Beneficiary name.
     */
    public string $name;

    /**
     * Beneficiary account number at the destination bank.
     */
    public string $bankAccountTo;

    /**
     * Beneficiary address line 1.
     */
    public ?string $address1 = null;

    /**
     * Beneficiary address line 2.
     */
    public ?string $address2 = null;

    /**
     * Beneficiary address line 3.
     */
    public ?string $address3 = null;

    /**
     * Beneficiary city.
     */
    public ?string $city = null;

    /**
     * Beneficiary state.
     */
    public ?string $state = null;

    /**
     * Beneficiary postal code.
     */
    public ?string $postalCode = null;

    /**
     * Beneficiary country.
     */
    public ?string $country = null;

    /**
     * Beneficiary phone number.
     */
    public ?string $phone = null;

    /**
     * Memo for the beneficiary.
     */
    public ?string $memo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'NAME' => 'name',
            'BANKACCTTO' => 'bankAccountTo',
            'ADDR1' => 'address1',
            'ADDR2' => 'address2',
            'ADDR3' => 'address3',
            'CITY' => 'city',
            'STATE' => 'state',
            'POSTALCODE' => 'postalCode',
            'COUNTRY' => 'country',
            'PHONE' => 'phone',
            'MEMO' => 'memo',
        ];
    }
}
