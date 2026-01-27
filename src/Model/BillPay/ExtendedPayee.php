<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Extended Payee aggregate.
 *
 * Contains extended payee information.
 */
class ExtendedPayee extends Aggregate
{
    /**
     * Payee ID code assigned by payor.
     */
    public ?string $payeeId = null;

    /**
     * Payee ID code type: TAXID, SIC.
     */
    public ?string $idScope = null;

    /**
     * Payee name.
     */
    public ?string $name = null;

    /**
     * Daytime phone number.
     */
    public ?string $daytimePhone = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'PAYEEID' => 'payeeId',
            'IDSCOPE' => 'idScope',
            'NAME' => 'name',
            'DATEFONE' => 'daytimePhone',
        ];
    }
}
