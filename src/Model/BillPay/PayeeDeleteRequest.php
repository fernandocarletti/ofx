<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payee Delete Request aggregate.
 *
 * Request to delete a payee from the payee list.
 */
class PayeeDeleteRequest extends Aggregate
{
    /**
     * Payee list ID of payee to delete.
     */
    public string $payeeListId;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'PAYEELSTID' => 'payeeListId',
        ];
    }
}
