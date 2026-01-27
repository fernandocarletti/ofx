<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\Payee;

/**
 * Payee Modification Request aggregate.
 *
 * Request to modify an existing payee.
 */
class PayeeModRequest extends Aggregate
{
    /**
     * Payee list ID of payee to modify.
     */
    public string $payeeListId;

    /**
     * Updated payee information.
     */
    public ?Payee $payee = null;

    /**
     * Updated bank account number at the payee.
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
            'PAYEELSTID' => 'payeeListId',
            'PAYEE' => 'payee',
            'PAYACCT' => 'payeeAccount',
        ];
    }
}
