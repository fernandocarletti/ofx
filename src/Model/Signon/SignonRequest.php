<?php

declare(strict_types=1);

namespace Ofx\Model\Signon;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Language;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Signon Request aggregate.
 *
 * Contains signon request information.
 */
class SignonRequest extends Aggregate
{
    /**
     * Date and time of client request.
     */
    public DateTimeImmutable $clientDate;

    /**
     * User ID.
     */
    public ?string $userId = null;

    /**
     * User password.
     */
    public ?string $userPassword = null;

    /**
     * Generate user key for future requests.
     */
    public ?bool $generateUserKey = null;

    /**
     * Language.
     */
    public Language $language;

    /**
     * Financial institution.
     */
    public ?FinancialInstitution $financialInstitution = null;

    /**
     * Session cookie.
     */
    public ?string $sessionCookie = null;

    /**
     * Application ID.
     */
    public ?string $applicationId = null;

    /**
     * Application version.
     */
    public ?string $applicationVersion = null;

    /**
     * Client user ID.
     */
    public ?string $clientUserId = null;

    /**
     * User credential 1.
     */
    public ?string $userCredential1 = null;

    /**
     * User credential 2.
     */
    public ?string $userCredential2 = null;

    /**
     * Access key.
     */
    public ?string $accessKey = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DTCLIENT' => 'clientDate',
            'USERID' => 'userId',
            'USERPASS' => 'userPassword',
            'GENUSERKEY' => 'generateUserKey',
            'LANGUAGE' => 'language',
            'FI' => 'financialInstitution',
            'SESSCOOKIE' => 'sessionCookie',
            'APPID' => 'applicationId',
            'APPVER' => 'applicationVersion',
            'CLIENTUID' => 'clientUserId',
            'USERCRED1' => 'userCredential1',
            'USERCRED2' => 'userCredential2',
            'ACCESSKEY' => 'accessKey',
        ];
    }

    /**
     * Parse property value with special handling for enum.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        $tagName = $child->getName();

        if ($tagName === 'LANGUAGE') {
            return Language::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
