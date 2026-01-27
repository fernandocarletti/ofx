<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Sell Debt transaction aggregate.
 */
class SellDebt extends Aggregate
{
    /**
     * Investment sell details.
     */
    public InvestmentSell $investmentSell;

    /**
     * Sell reason.
     */
    public ?string $sellReason = null;

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
            'INVSELL' => 'investmentSell',
            'SELLREASON' => 'sellReason',
            'ACCRDINT' => 'accruedInterest',
        ];
    }
}
