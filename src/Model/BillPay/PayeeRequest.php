<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\Payee;

/**
 * Payee Request aggregate.
 *
 * Request to add a new payee.
 */
class PayeeRequest extends Aggregate
{
    /**
     * Payee information.
     */
    public Payee $payee;

    /**
     * Bank account number at the payee (optional).
     */
    public ?string $payeeAccount = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'PAYEE' => 'payee',
            'PAYACCT' => 'payeeAccount',
        ];
    }
}
