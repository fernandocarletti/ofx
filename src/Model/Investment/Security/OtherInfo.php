<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\AssetClass;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Other Info aggregate.
 *
 * Contains information for security types that don't fit
 * into the standard categories (stock, debt, mutual fund, option).
 */
class OtherInfo extends Aggregate
{
    /**
     * Base security information.
     */
    public SecurityInfo $securityInfo;

    /**
     * Type description for this security.
     */
    public ?string $typeDescription = null;

    /**
     * Asset class.
     */
    public ?AssetClass $assetClass = null;

    /**
     * FI-defined asset class.
     */
    public ?string $financialInstitutionAssetClass = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECINFO' => 'securityInfo',
            'TYPEDESC' => 'typeDescription',
            'ASSETCLASS' => 'assetClass',
            'FIASSETCLASS' => 'financialInstitutionAssetClass',
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
        $tagName = $child->getName();

        if ($tagName === 'ASSETCLASS') {
            return AssetClass::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
