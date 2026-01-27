<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Proceeds Detail aggregate.
 *
 * Detailed proceeds information for 1099-B transactions.
 */
class ProcDet extends Aggregate
{
    /**
     * Form 8949 box code (optional).
     */
    public ?string $form8949Code = null;

    /**
     * Date acquired (optional).
     */
    public ?DateTimeImmutable $dateAcquired = null;

    /**
     * Date sold (optional).
     */
    public ?DateTimeImmutable $dateSold = null;

    /**
     * Security name (optional).
     */
    public ?string $securityName = null;

    /**
     * Cost basis (optional).
     */
    public ?string $costBasis = null;

    /**
     * Sales proceeds (optional).
     */
    public ?string $salesProceeds = null;

    /**
     * Long/short term indicator (optional).
     */
    public ?string $longShort = null;

    /**
     * Ordinary gain indicator (optional).
     */
    public ?bool $ordinary = null;

    /**
     * Wash sale loss disallowed (optional).
     */
    public ?string $washSaleLossDisallowed = null;

    /**
     * Federal income tax withheld (optional).
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Noncovered security indicator (optional).
     */
    public ?bool $noncoveredSecurity = null;

    /**
     * Basis reported to IRS indicator (optional).
     */
    public ?bool $basisNotShown = null;

    /**
     * Cost basis reporting indicator (optional).
     */
    public ?string $costBasisReported = null;

    /**
     * Bartering exchange indicator (optional).
     */
    public ?bool $bartering = null;

    /**
     * Gross proceeds indicator (optional).
     */
    public ?bool $grossOrNet = null;

    /**
     * Accrued market discount (optional).
     */
    public ?string $accruedMarketDiscount = null;

    /**
     * Loss not allowed (optional).
     */
    public ?string $lossNotAllowed = null;

    /**
     * State information (optional).
     */
    public ?StateInfo $stateInfo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'FORM8949CODE' => 'form8949Code',
            'DTAQD' => 'dateAcquired',
            'DTSALE' => 'dateSold',
            'SECNAME' => 'securityName',
            'COSTBASIS' => 'costBasis',
            'SALESPR' => 'salesProceeds',
            'LONGSHORT' => 'longShort',
            'ORDINARY' => 'ordinary',
            'WASHSALELOSSDISALLOWED' => 'washSaleLossDisallowed',
            'FEDTAXWH' => 'federalTaxWithheld',
            'NONCOVEREDSEC' => 'noncoveredSecurity',
            'BASISNOTSHOWN' => 'basisNotShown',
            'COSTBASISRPTD' => 'costBasisReported',
            'BARTERING' => 'bartering',
            'GROSSORNET' => 'grossOrNet',
            'ACCRUEDMKTDISCOUNT' => 'accruedMarketDiscount',
            'LOSSNOTALLOWED' => 'lossNotAllowed',
            'STATEINFO' => 'stateInfo',
        ];
    }
}
