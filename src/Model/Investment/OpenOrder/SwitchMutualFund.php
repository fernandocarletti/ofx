<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\OpenOrder;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Duration;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Enum\UnitType;
use Ofx\Model\Common\Currency;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Switch Mutual Fund aggregate.
 *
 * Represents an open order to switch between mutual funds.
 */
class SwitchMutualFund extends Aggregate
{
    /**
     * FI-assigned unique ID for this order.
     */
    public string $financialInstitutionTransactionId;

    /**
     * Server-assigned transaction ID.
     */
    public ?string $serverTransactionId = null;

    /**
     * Security ID to switch from.
     */
    public SecurityId $securityId;

    /**
     * Security ID to switch to.
     */
    public SecurityId $securityIdTo;

    /**
     * Date/time order was placed.
     */
    public DateTimeImmutable $placedDate;

    /**
     * Unit type.
     */
    public UnitType $unitType;

    /**
     * Switch all units.
     */
    public ?bool $switchAll = null;

    /**
     * Number of units.
     */
    public ?string $units = null;

    /**
     * Sub-account type.
     */
    public InvestmentSubAccount $subAccount;

    /**
     * Duration of the order.
     */
    public Duration $duration;

    /**
     * Memo.
     */
    public ?string $memo = null;

    /**
     * Currency information.
     */
    public ?Currency $currency = null;

    /**
     * 401(k) source.
     */
    public ?Investment401kSource $investment401kSource = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'FITID' => 'financialInstitutionTransactionId',
            'SRVRTID' => 'serverTransactionId',
            'SECID' => 'securityId',
            'SECIDTO' => 'securityIdTo',
            'DTPLACED' => 'placedDate',
            'UNITTYPE' => 'unitType',
            'SWITCHALL' => 'switchAll',
            'UNITS' => 'units',
            'SUBACCT' => 'subAccount',
            'DURATION' => 'duration',
            'MEMO' => 'memo',
            'CURRENCY' => 'currency',
            'INV401KSOURCE' => 'investment401kSource',
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

        if ($tagName === 'UNITTYPE') {
            return UnitType::from(trim((string) $child));
        }

        if ($tagName === 'SUBACCT') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        if ($tagName === 'DURATION') {
            return Duration::from(trim((string) $child));
        }

        if ($tagName === 'INV401KSOURCE') {
            return Investment401kSource::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
