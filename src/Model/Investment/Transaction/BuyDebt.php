<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Buy Debt transaction aggregate.
 */
class BuyDebt extends Aggregate
{
    /**
     * Investment buy details.
     */
    public InvestmentBuy $investmentBuy;

    /**
     * Accrued interest.
     */
    public ?string $accruedInterest = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVBUY' => 'investmentBuy',
            'ACCRDINT' => 'accruedInterest',
        ];
    }
}
