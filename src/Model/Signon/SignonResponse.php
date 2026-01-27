<?php

declare(strict_types=1);

namespace Ofx\Model\Signon;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Language;
use Ofx\Model\Common\Status;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Signon Response aggregate.
 *
 * Contains signon response information.
 */
class SignonResponse extends Aggregate
{
    /**
     * Response status.
     */
    public Status $status;

    /**
     * Date and time of server response.
     */
    public DateTimeImmutable $serverDate;

    /**
     * User key for subsequent requests.
     */
    public ?string $userKey = null;

    /**
     * Token timestamp for session timeout.
     */
    public ?DateTimeImmutable $tokenExpiration = null;

    /**
     * Response language.
     */
    public Language $language;

    /**
     * Date and time of last profile update.
     */
    public ?DateTimeImmutable $profileUpdateDate = null;

    /**
     * Date and time of last account update.
     */
    public ?DateTimeImmutable $accountUpdateDate = null;

    /**
     * Financial institution information.
     */
    public ?FinancialInstitution $financialInstitution = null;

    /**
     * Session cookie for maintaining session.
     */
    public ?string $sessionCookie = null;

    /**
     * Access key for subsequent requests.
     */
    public ?string $accessKey = null;

    /**
     * MFA challenges.
     *
     * @var array<MfaChallenge>
     */
    public array $mfaChallenges {
        get => array_filter(
            $this->listItems,
            fn($item) => $item instanceof MfaChallenge,
        );
    }

    /**
     * MFA challenge list.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['MFACHALLENGE'];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'STATUS' => 'status',
            'DTSERVER' => 'serverDate',
            'USERKEY' => 'userKey',
            'TSKEYEXPIRE' => 'tokenExpiration',
            'LANGUAGE' => 'language',
            'DTPROFUP' => 'profileUpdateDate',
            'DTACCTUP' => 'accountUpdateDate',
            'FI' => 'financialInstitution',
            'SESSCOOKIE' => 'sessionCookie',
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
