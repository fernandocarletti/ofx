<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Buy Other transaction aggregate.
 */
class BuyOther extends Aggregate
{
    /**
     * Investment buy details.
     */
    public InvestmentBuy $investmentBuy;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVBUY' => 'investmentBuy',
        ];
    }
}
