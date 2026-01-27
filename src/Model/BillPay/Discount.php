<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Discount aggregate.
 *
 * Contains discount information for an invoice.
 */
class Discount extends Aggregate
{
    /**
     * Discount amount (use bcmath for precision).
     */
    public ?string $discountAmount = null;

    /**
     * Discount date (date by which discount applies).
     */
    public ?DateTimeImmutable $discountDate = null;

    /**
     * Discount description.
     */
    public ?string $discountDescription = null;

    /**
     * Discount rate (percentage).
     */
    public ?string $discountRate = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DSCAMT' => 'discountAmount',
            'DSCDATE' => 'discountDate',
            'DSCDESC' => 'discountDescription',
            'DSCRATE' => 'discountRate',
        ];
    }
}
