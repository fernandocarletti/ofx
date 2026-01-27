<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Position;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Enum\PositionType;
use Ofx\Model\Common\Currency;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Investment Position aggregate.
 *
 * Base position information for all investment position types.
 * Contains the security identifier, units, unit price, market value,
 * and various pricing and date information.
 */
class InvestmentPosition extends Aggregate
{
    /**
     * Security identifier.
     */
    public SecurityId $securityId;

    /**
     * Number of units or shares held.
     */
    public string $units;

    /**
     * Price per unit.
     */
    public string $unitPrice;

    /**
     * Market value of the position.
     */
    public string $marketValue;

    /**
     * Average cost basis per unit.
     */
    public ?string $averageCostBasis = null;

    /**
     * Date of the unit price.
     */
    public ?DateTimeImmutable $priceAsOfDate = null;

    /**
     * Currency information.
     */
    public ?Currency $currency = null;

    /**
     * Memo or description.
     */
    public ?string $memo = null;

    /**
     * Position type (LONG or SHORT).
     */
    public ?PositionType $positionType = null;

    /**
     * Sub-account type.
     */
    public InvestmentSubAccount $subAccount;

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
            'SECID' => 'securityId',
            'UNITS' => 'units',
            'UNITPRICE' => 'unitPrice',
            'MKTVAL' => 'marketValue',
            'AVGCOSTBASIS' => 'averageCostBasis',
            'DTPRICEASOF' => 'priceAsOfDate',
            'CURRENCY' => 'currency',
            'MEMO' => 'memo',
            'POSTYPE' => 'positionType',
            'SUBACCT' => 'subAccount',
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

        if ($tagName === 'POSTYPE') {
            return PositionType::from(trim((string) $child));
        }

        if ($tagName === 'SUBACCT') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        if ($tagName === 'INV401KSOURCE') {
            return Investment401kSource::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
