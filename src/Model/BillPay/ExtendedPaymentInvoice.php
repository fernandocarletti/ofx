<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Extended Payment Invoice aggregate.
 *
 * Contains invoice information for extended payments.
 */
class ExtendedPaymentInvoice extends Aggregate
{
    /**
     * Invoice information.
     */
    public ?Invoice $invoice = null;

    /**
     * Amount paid towards this invoice (use bcmath for precision).
     */
    public ?string $amount = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVOICE' => 'invoice',
            'AMT' => 'amount',
        ];
    }
}
