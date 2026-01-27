<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Security Sales Information aggregate (STKBND).
 *
 * Stock and bond sales information for 1099-B.
 */
class SecuritySalesInfo extends Aggregate
{
    /**
     * Security name/description.
     */
    public ?string $securityName = null;

    /**
     * Number of shares or units sold (optional).
     */
    public ?string $numberOfShares = null;

    /**
     * Date acquired (optional).
     */
    public ?DateTimeImmutable $dateAcquired = null;

    /**
     * Date sold (optional).
     */
    public ?DateTimeImmutable $dateSold = null;

    /**
     * Cost or other basis (optional).
     */
    public ?string $costBasis = null;

    /**
     * Gross proceeds from sale (optional).
     */
    public ?string $salesProceeds = null;

    /**
     * Long-term gain/loss indicator (optional).
     */
    public ?bool $longShort = null;

    /**
     * Ordinary gain/loss indicator (optional).
     */
    public ?bool $ordinary = null;

    /**
     * Wash sale loss disallowed (optional).
     */
    public ?string $washSale = null;

    /**
     * Federal income tax withheld (optional).
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECNAME' => 'securityName',
            'NUMSHRS' => 'numberOfShares',
            'DTAQD' => 'dateAcquired',
            'DTSALE' => 'dateSold',
            'COSTBASIS' => 'costBasis',
            'SALESPR' => 'salesProceeds',
            'LONGSHORT' => 'longShort',
            'ORDINARY' => 'ordinary',
            'WASHSALE' => 'washSale',
            'FEDTAXWH' => 'federalTaxWithheld',
        ];
    }
}
