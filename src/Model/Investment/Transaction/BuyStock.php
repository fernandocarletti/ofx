<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Buy Stock transaction aggregate.
 */
class BuyStock extends Aggregate
{
    /**
     * Investment buy details.
     */
    public InvestmentBuy $investmentBuy;

    /**
     * Buy type (BUY or BUYTOCOVER).
     */
    public string $buyType;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVBUY' => 'investmentBuy',
            'BUYTYPE' => 'buyType',
        ];
    }
}
