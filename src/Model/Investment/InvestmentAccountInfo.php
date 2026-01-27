<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\ServiceStatus;
use Ofx\Enum\UsageType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Investment Account Info aggregate.
 *
 * Information about an investment account.
 */
class InvestmentAccountInfo extends Aggregate
{
    /**
     * Investment account.
     */
    public InvestmentAccount $investmentAccountFrom;

    /**
     * Usage type.
     */
    public ?UsageType $usageType = null;

    /**
     * Checking account available for transfers.
     */
    public ?bool $checking = null;

    /**
     * Service status.
     */
    public ?ServiceStatus $serviceStatus = null;

    /**
     * Investment account type (e.g., individual, joint, trust).
     */
    public ?string $investmentAccountType = null;

    /**
     * Option level.
     */
    public ?int $optionLevel = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVACCTFROM' => 'investmentAccountFrom',
            'USAGETYPE' => 'usageType',
            'CHECKING' => 'checking',
            'SVCSTATUS' => 'serviceStatus',
            'INVACCTTYPE' => 'investmentAccountType',
            'OPTIONLEVEL' => 'optionLevel',
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

        if ($tagName === 'USAGETYPE') {
            return UsageType::from(trim((string) $child));
        }

        if ($tagName === 'SVCSTATUS') {
            return ServiceStatus::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
