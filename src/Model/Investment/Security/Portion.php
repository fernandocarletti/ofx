<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\AssetClass;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Portion aggregate.
 *
 * Represents a portion of a mutual fund's asset allocation
 * using standard OFX asset classes.
 */
class Portion extends Aggregate
{
    /**
     * Asset class.
     */
    public AssetClass $assetclass;

    /**
     * Percentage of fund in this asset class.
     */
    public string $percent;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'ASSETCLASS' => 'assetclass',
            'PERCENT' => 'percent',
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
