<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\Payee;

/**
 * Payee Response aggregate.
 *
 * Response to a payee add request.
 */
class PayeeResponse extends Aggregate
{
    /**
     * Server-assigned payee list ID.
     */
    public string $payeeListId;

    /**
     * Payee information.
     */
    public ?Payee $payee = null;

    /**
     * Bank account number at the payee.
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
