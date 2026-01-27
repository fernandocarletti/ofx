<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Adjustment aggregate.
 *
 * Contains adjustment information for an invoice.
 */
class Adjustment extends Aggregate
{
    /**
     * Adjustment amount (use bcmath for precision).
     */
    public ?string $adjustmentAmount = null;

    /**
     * Adjustment description.
     */
    public ?string $adjustmentDescription = null;

    /**
     * Adjustment reason.
     */
    public ?string $adjustmentReason = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'ADJAMT' => 'adjustmentAmount',
            'ADJDESC' => 'adjustmentDescription',
            'ADJREASON' => 'adjustmentReason',
        ];
    }
}
