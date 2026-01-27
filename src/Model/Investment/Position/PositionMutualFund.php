<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Position;

use Ofx\Aggregate\Aggregate;

/**
 * Mutual Fund Position aggregate.
 *
 * Represents a position in a mutual fund security.
 */
class PositionMutualFund extends Aggregate
{
    /**
     * Base investment position details.
     */
    public InvestmentPosition $investmentPosition;

    /**
     * Number of shares for which reinvestment is based.
     */
    public ?string $unitsStreet = null;

    /**
     * Units held in user's name.
     */
    public ?string $unitsUser = null;

    /**
     * Reinvest dividends.
     */
    public ?bool $reinvestDividend = null;

    /**
     * Reinvest capital gains.
     */
    public ?bool $reinvestCapitalGains = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVPOS' => 'investmentPosition',
            'UNITSSTREET' => 'unitsStreet',
            'UNITSUSER' => 'unitsUser',
            'REINVDIV' => 'reinvestDividend',
            'REINVCG' => 'reinvestCapitalGains',
        ];
    }
}
