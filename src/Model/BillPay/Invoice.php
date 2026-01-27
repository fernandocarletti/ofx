<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Invoice aggregate.
 *
 * Contains invoice information for bill payment.
 */
class Invoice extends Aggregate
{
    /**
     * Invoice number.
     */
    public ?string $invoiceNumber = null;

    /**
     * Invoice date.
     */
    public ?DateTimeImmutable $invoiceDate = null;

    /**
     * Invoice total amount (use bcmath for precision).
     */
    public ?string $invoiceTotalAmount = null;

    /**
     * Invoice paid amount (use bcmath for precision).
     */
    public ?string $invoicePaidAmount = null;

    /**
     * Invoice description.
     */
    public ?string $invoiceDescription = null;

    /**
     * Discount information.
     */
    public ?Discount $discount = null;

    /**
     * Adjustment information.
     */
    public ?Adjustment $adjustment = null;

    /**
     * All line items.
     *
     * @var array<LineItem>
     */
    public array $lineItems {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of line items.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'LINEITEM',
    ];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVNO' => 'invoiceNumber',
            'INVDATE' => 'invoiceDate',
            'INVTOTALAMT' => 'invoiceTotalAmount',
            'INVPAIDAMT' => 'invoicePaidAmount',
            'INVDESC' => 'invoiceDescription',
            'DISCOUNT' => 'discount',
            'ADJUSTMENT' => 'adjustment',
        ];
    }
}
