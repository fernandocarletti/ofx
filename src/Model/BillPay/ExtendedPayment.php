<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Extended Payment aggregate.
 *
 * Contains extended payment information for business payments.
 */
class ExtendedPayment extends Aggregate
{
    /**
     * Extended payment type: CHECK, REMITTANCE.
     */
    public ?string $extendedPaymentFor = null;

    /**
     * Check number (if EXTDPMTFOR is CHECK).
     */
    public ?string $extendedPaymentCheck = null;

    /**
     * Extended payment description.
     */
    public ?string $extendedPaymentDescription = null;

    /**
     * All extended payment invoices.
     *
     * @var array<ExtendedPaymentInvoice>
     */
    public array $extendedPaymentInvoices {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of extended payment invoices.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'EXTDPMTINV',
    ];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'EXTDPMTFOR' => 'extendedPaymentFor',
            'EXTDPMTCHK' => 'extendedPaymentCheck',
            'EXTDPMTDSC' => 'extendedPaymentDescription',
        ];
    }
}
