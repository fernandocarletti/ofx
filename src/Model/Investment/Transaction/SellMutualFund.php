<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Sell Mutual Fund transaction aggregate.
 */
class SellMutualFund extends Aggregate
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
     * Average cost basis.
     */
    public ?string $averageCostBasis = null;

    /**
     * Related transaction ID.
     */
    public ?string $relatedFinancialInstitutionTransactionId = null;

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
            'AVGCOSTBASIS' => 'averageCostBasis',
            'RELFITID' => 'relatedFinancialInstitutionTransactionId',
        ];
    }
}
