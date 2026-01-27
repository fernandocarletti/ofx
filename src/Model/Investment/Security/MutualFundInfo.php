<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\MutualFundType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Mutual Fund Info aggregate.
 *
 * Contains information specific to mutual fund securities.
 */
class MutualFundInfo extends Aggregate
{
    /**
     * Base security information.
     */
    public SecurityInfo $securityInfo;

    /**
     * Mutual fund type (OPENEND, CLOSEEND, OTHER).
     */
    public ?MutualFundType $mutualFundType = null;

    /**
     * Current yield.
     */
    public ?string $yield = null;

    /**
     * Date yield is calculated as of.
     */
    public ?DateTimeImmutable $yieldAsOfDate = null;

    /**
     * Asset class breakdown using standard asset classes.
     */
    public ?MutualFundAssetClass $mutualFundAssetClass = null;

    /**
     * Asset class breakdown using FI-defined asset classes.
     */
    public ?FiMutualFundAssetClass $financialInstitutionMutualFundAssetClass = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECINFO' => 'securityInfo',
            'MFTYPE' => 'mutualFundType',
            'YIELD' => 'yield',
            'DTYIELDASOF' => 'yieldAsOfDate',
            'MFASSETCLASS' => 'mutualFundAssetClass',
            'FIMFASSETCLASS' => 'financialInstitutionMutualFundAssetClass',
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

        if ($tagName === 'MFTYPE') {
            return MutualFundType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
