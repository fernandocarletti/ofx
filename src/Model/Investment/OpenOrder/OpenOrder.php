<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\OpenOrder;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Duration;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Enum\Restriction;
use Ofx\Enum\UnitType;
use Ofx\Model\Common\Currency;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Open Order aggregate.
 *
 * Base aggregate for open (pending) orders.
 * Contains common fields for all open order types.
 */
class OpenOrder extends Aggregate
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
     * Security identifier.
     */
    public SecurityId $securityId;

    /**
     * Date/time order was placed.
     */
    public DateTimeImmutable $placedDate;

    /**
     * Unit type.
     */
    public UnitType $unitType;

    /**
     * Number of units.
     */
    public string $units;

    /**
     * Sub-account type.
     */
    public InvestmentSubAccount $subAccount;

    /**
     * Duration of the order.
     */
    public Duration $duration;

    /**
     * Order restrictions.
     */
    public Restriction $restriction;

    /**
     * Minimum units for restriction.
     */
    public ?string $minimumUnits = null;

    /**
     * Limit price.
     */
    public ?string $limitPrice = null;

    /**
     * Stop price.
     */
    public ?string $stopPrice = null;

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
            'DTPLACED' => 'placedDate',
            'UNITTYPE' => 'unitType',
            'UNITS' => 'units',
            'SUBACCT' => 'subAccount',
            'DURATION' => 'duration',
            'RESTRICTION' => 'restriction',
            'MINUNITS' => 'minimumUnits',
            'LIMITPRICE' => 'limitPrice',
            'STOPPRICE' => 'stopPrice',
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

        if ($tagName === 'RESTRICTION') {
            return Restriction::from(trim((string) $child));
        }

        if ($tagName === 'INV401KSOURCE') {
            return Investment401kSource::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
