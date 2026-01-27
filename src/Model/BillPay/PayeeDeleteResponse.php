<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Payee Delete Response aggregate.
 *
 * Response to a payee delete request.
 */
class PayeeDeleteResponse extends Aggregate
{
    /**
     * Payee list ID that was deleted.
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
