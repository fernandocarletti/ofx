<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;

/**
 * Buy Mutual Fund transaction aggregate.
 */
class BuyMutualFund extends Aggregate
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
     * Related transaction type for reinvestment.
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
            'INVBUY' => 'investmentBuy',
            'BUYTYPE' => 'buyType',
            'RELFITID' => 'relatedFinancialInstitutionTransactionId',
        ];
    }
}
