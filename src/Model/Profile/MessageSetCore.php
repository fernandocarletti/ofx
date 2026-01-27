<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Language;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Message Set Core aggregate.
 *
 * Contains core information about a message set supported by the FI.
 */
class MessageSetCore extends Aggregate
{
    /**
     * Version of the message set.
     */
    public string $version;

    /**
     * URL for the message set.
     */
    public string $url;

    /**
     * URL for OFX server errors.
     */
    public ?string $ofxSecurity = null;

    /**
     * Transport security (TRUE or FALSE).
     */
    public ?bool $transportSecurity = null;

    /**
     * Signon realm.
     */
    public ?string $signonRealm = null;

    /**
     * Language.
     */
    public Language $language;

    /**
     * Sync mode (FULL, LITE).
     */
    public ?string $syncMode = null;

    /**
     * Refresh support.
     */
    public ?bool $refreshSupport = null;

    /**
     * Response file error recovery.
     */
    public ?bool $responseFileErrorRecovery = null;

    /**
     * Spool directory.
     */
    public ?string $spoolName = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'VER' => 'version',
            'URL' => 'url',
            'OFXSEC' => 'ofxSecurity',
            'TRANSPSEC' => 'transportSecurity',
            'SIGNONREALM' => 'signonRealm',
            'LANGUAGE' => 'language',
            'SYNCMODE' => 'syncMode',
            'REFRESHSUPT' => 'refreshSupport',
            'RESPFILEER' => 'responseFileErrorRecovery',
            'SPNAME' => 'spoolName',
        ];
    }

    /**
     * Parse property value with special handling for enums.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        if ($child->getName() === 'LANGUAGE') {
            return Language::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
