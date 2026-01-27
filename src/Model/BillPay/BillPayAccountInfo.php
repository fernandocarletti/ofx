<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\BankAccount;

/**
 * Bill Pay Account Info aggregate.
 *
 * Contains bill payment account information.
 */
class BillPayAccountInfo extends Aggregate
{
    /**
     * Bank account for bill pay.
     */
    public ?BankAccount $bankAccountFrom = null;

    /**
     * Bill pay service status - Y for active, N for inactive.
     */
    public ?string $serviceStatus = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BANKACCTFROM' => 'bankAccountFrom',
            'SVCSTATUS' => 'serviceStatus',
        ];
    }
}
