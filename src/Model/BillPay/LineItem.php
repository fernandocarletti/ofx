<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Line Item aggregate.
 *
 * Contains line item information for an invoice.
 */
class LineItem extends Aggregate
{
    /**
     * Line number.
     */
    public ?string $lineItemNumber = null;

    /**
     * Line item description.
     */
    public ?string $lineItemDescription = null;

    /**
     * Item ID/SKU.
     */
    public ?string $lineItemId = null;

    /**
     * Line item amount (use bcmath for precision).
     */
    public ?string $lineItemAmount = null;

    /**
     * Quantity.
     */
    public ?string $lineItemQuantity = null;

    /**
     * Unit price (use bcmath for precision).
     */
    public ?string $lineItemUnitPrice = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'LITMNUM' => 'lineItemNumber',
            'LITMDESC' => 'lineItemDescription',
            'LITMID' => 'lineItemId',
            'LITMAMT' => 'lineItemAmount',
            'LITMQTY' => 'lineItemQuantity',
            'LITMUPRC' => 'lineItemUnitPrice',
        ];
    }
}
