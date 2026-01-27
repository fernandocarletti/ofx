<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Sell Stock transaction aggregate.
 */
class SellStock extends Aggregate
{
    /**
     * Investment sell details.
     */
    public InvestmentSell $investmentSell;

    /**
     * Sell type (SELL or SELLSHORT).
     */
    public string $sellType;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVSELL' => 'investmentSell',
            'SELLTYPE' => 'sellType',
        ];
    }
}
