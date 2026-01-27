<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Sell Other transaction aggregate.
 */
class SellOther extends Aggregate
{
    /**
     * Investment sell details.
     */
    public InvestmentSell $investmentSell;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVSELL' => 'investmentSell',
        ];
    }
}
