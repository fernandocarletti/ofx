<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\Payee;

/**
 * Payee Modification Response aggregate.
 *
 * Response to a payee modification request.
 */
class PayeeModResponse extends Aggregate
{
    /**
     * Payee list ID.
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
     * Extended payee information.
     */
    public ?ExtendedPayee $extendedPayee = null;

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
            'EXTDPAYEE' => 'extendedPayee',
        ];
    }
}
