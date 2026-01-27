<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\AssetClass;
use Ofx\Enum\CallType;
use Ofx\Enum\CouponFrequency;
use Ofx\Enum\DebtClass;
use Ofx\Enum\DebtType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Debt Info aggregate.
 *
 * Contains information specific to debt securities (bonds, etc.).
 */
class DebtInfo extends Aggregate
{
    /**
     * Base security information.
     */
    public SecurityInfo $securityInfo;

    /**
     * Par value.
     */
    public string $parValue;

    /**
     * Debt type (COUPON or ZERO).
     */
    public DebtType $debtType;

    /**
     * Debt class (TREASURY, MUNICIPAL, CORPORATE, OTHER).
     */
    public ?DebtClass $debtClass = null;

    /**
     * Coupon rate.
     */
    public ?string $couponRate = null;

    /**
     * Next coupon date.
     */
    public ?DateTimeImmutable $couponDate = null;

    /**
     * Coupon frequency.
     */
    public ?CouponFrequency $couponFrequency = null;

    /**
     * Call price.
     */
    public ?string $callPrice = null;

    /**
     * Yield to call.
     */
    public ?string $yieldToCall = null;

    /**
     * Next call date.
     */
    public ?DateTimeImmutable $callDate = null;

    /**
     * Call type.
     */
    public ?CallType $callType = null;

    /**
     * Yield to maturity.
     */
    public ?string $yieldToMaturity = null;

    /**
     * Maturity date.
     */
    public ?DateTimeImmutable $maturityDate = null;

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
            'PARVALUE' => 'parValue',
            'DEBTTYPE' => 'debtType',
            'DEBTCLASS' => 'debtClass',
            'COUPONRT' => 'couponRate',
            'DTCOUPON' => 'couponDate',
            'COUPONFREQ' => 'couponFrequency',
            'CALLPRICE' => 'callPrice',
            'YIELDTOCALL' => 'yieldToCall',
            'DTCALL' => 'callDate',
            'CALLTYPE' => 'callType',
            'YIELDTOMAT' => 'yieldToMaturity',
            'DTMAT' => 'maturityDate',
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

        if ($tagName === 'DEBTTYPE') {
            return DebtType::from(trim((string) $child));
        }

        if ($tagName === 'DEBTCLASS') {
            return DebtClass::from(trim((string) $child));
        }

        if ($tagName === 'COUPONFREQ') {
            return CouponFrequency::from(trim((string) $child));
        }

        if ($tagName === 'CALLTYPE') {
            return CallType::from(trim((string) $child));
        }

        if ($tagName === 'ASSETCLASS') {
            return AssetClass::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
