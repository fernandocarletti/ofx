<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\ServiceStatus;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Credit Card Account Info aggregate.
 *
 * Contains credit card account information for signup.
 */
class CreditCardAccountInfo extends Aggregate
{
    /**
     * Credit card account information.
     */
    public CreditCardAccount $creditCardAccountFrom;

    /**
     * Supports transaction download.
     */
    public bool $supportsTransactionDownload;

    /**
     * Can be used as transfer source.
     */
    public bool $transferSource;

    /**
     * Can be used as transfer destination.
     */
    public bool $transferDestination;

    /**
     * Service status.
     */
    public ServiceStatus $serviceStatus;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CCACCTFROM' => 'creditCardAccountFrom',
            'SUPTXDL' => 'supportsTransactionDownload',
            'XFERSRC' => 'transferSource',
            'XFERDEST' => 'transferDestination',
            'SVCSTATUS' => 'serviceStatus',
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

        if ($tagName === 'SVCSTATUS') {
            return ServiceStatus::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
