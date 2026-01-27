<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\AssetClass;
use Ofx\Enum\OptionType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Option Info aggregate.
 *
 * Contains information specific to option securities.
 */
class OptionInfo extends Aggregate
{
    /**
     * Base security information.
     */
    public SecurityInfo $securityInfo;

    /**
     * Option type (CALL or PUT).
     */
    public OptionType $optionType;

    /**
     * Strike price.
     */
    public string $strikePrice;

    /**
     * Expiration date.
     */
    public DateTimeImmutable $expirationDate;

    /**
     * Shares per contract.
     */
    public int $sharesPerContract;

    /**
     * Security ID of the underlying security.
     */
    public ?SecurityId $securityId = null;

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
            'OPTTYPE' => 'optionType',
            'STRIKEPRICE' => 'strikePrice',
            'DTEXPIRE' => 'expirationDate',
            'SHPERCTRCT' => 'sharesPerContract',
            'SECID' => 'securityId',
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

        if ($tagName === 'OPTTYPE') {
            return OptionType::from(trim((string) $child));
        }

        if ($tagName === 'ASSETCLASS') {
            return AssetClass::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
