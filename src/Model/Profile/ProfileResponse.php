<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Profile Response aggregate.
 *
 * Response containing FI profile information.
 */
class ProfileResponse extends Aggregate
{
    /**
     * Message set list.
     */
    public MessageSetList $messageSetList;

    /**
     * Signon info list.
     */
    public ?Aggregate $signonInfoList = null;

    /**
     * Date/time of profile update.
     */
    public DateTimeImmutable $profileUpdateDate;

    /**
     * Financial institution name.
     */
    public string $financialInstitutionName;

    /**
     * Address line 1.
     */
    public ?string $addressLine1 = null;

    /**
     * Address line 2.
     */
    public ?string $addressLine2 = null;

    /**
     * Address line 3.
     */
    public ?string $addressLine3 = null;

    /**
     * City.
     */
    public ?string $city = null;

    /**
     * State.
     */
    public ?string $state = null;

    /**
     * Postal code.
     */
    public ?string $postalCode = null;

    /**
     * Country.
     */
    public ?string $country = null;

    /**
     * Customer service phone.
     */
    public ?string $customerServicePhone = null;

    /**
     * Technical support phone.
     */
    public ?string $technicalSupportPhone = null;

    /**
     * Fax phone.
     */
    public ?string $faxPhone = null;

    /**
     * URL.
     */
    public ?string $url = null;

    /**
     * Email.
     */
    public ?string $email = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'MSGSETLIST' => 'messageSetList',
            'SIGNONINFOLIST' => 'signonInfoList',
            'DTPROFUP' => 'profileUpdateDate',
            'FINAME' => 'financialInstitutionName',
            'ADDR1' => 'addressLine1',
            'ADDR2' => 'addressLine2',
            'ADDR3' => 'addressLine3',
            'CITY' => 'city',
            'STATE' => 'state',
            'POSTALCODE' => 'postalCode',
            'COUNTRY' => 'country',
            'CSPHONE' => 'customerServicePhone',
            'TSPHONE' => 'technicalSupportPhone',
            'FAXPHONE' => 'faxPhone',
            'URL' => 'url',
            'EMAIL' => 'email',
        ];
    }
}
