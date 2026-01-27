<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Balance;

/**
 * Investment Balance aggregate.
 *
 * Contains balance information for an investment account.
 */
class InvestmentBalance extends Aggregate
{
    /**
     * Available cash balance.
     */
    public ?string $availableCash = null;

    /**
     * Margin balance.
     */
    public ?string $marginValue = null;

    /**
     * Short stock value.
     */
    public ?string $shortValue = null;

    /**
     * Buying power.
     */
    public ?string $buyingPower = null;

    /**
     * Additional balance items.
     *
     * @var array<Balance>
     */
    public array $balances {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List property for additional balances.
     *
     * @var array<string>
     */
    protected static array $listProperties = ['BAL'];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'AVAILCASH' => 'availableCash',
            'MARGINVALUE' => 'marginValue',
            'SHORTVALUE' => 'shortValue',
            'BUYPOWER' => 'buyingPower',
        ];
    }
}
