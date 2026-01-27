<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\AssetClass;
use Ofx\Enum\StockType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Stock Info aggregate.
 *
 * Contains information specific to stock securities.
 */
class StockInfo extends Aggregate
{
    /**
     * Base security information.
     */
    public SecurityInfo $securityInfo;

    /**
     * Stock type (COMMON, PREFERRED, CONVERTIBLE, OTHER).
     */
    public ?StockType $stockType = null;

    /**
     * Current yield.
     */
    public ?string $yield = null;

    /**
     * Date yield is calculated as of.
     */
    public ?DateTimeImmutable $yieldAsOfDate = null;

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
            'STOCKTYPE' => 'stockType',
            'YIELD' => 'yield',
            'DTYIELDASOF' => 'yieldAsOfDate',
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

        if ($tagName === 'STOCKTYPE') {
            return StockType::from(trim((string) $child));
        }

        if ($tagName === 'ASSETCLASS') {
            return AssetClass::from(trim((string) $child));
        }

        if ($tagName === 'FIASSETCLASS') {
            return trim((string) $child);
        }

        return parent::parsePropertyValue($child, $property);
    }
}
