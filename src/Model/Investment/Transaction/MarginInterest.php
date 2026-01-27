<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Model\Common\Currency;
use Ofx\Model\Common\OrigCurrency;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Margin Interest transaction aggregate.
 */
class MarginInterest extends Aggregate
{
    /**
     * Investment transaction details.
     */
    public InvestmentTransaction $investmentTransaction;

    /**
     * Total amount.
     */
    public string $total;

    /**
     * Sub-account for fund.
     */
    public InvestmentSubAccount $subAccountFund;

    /**
     * Currency.
     */
    public ?Currency $currency = null;

    /**
     * Original currency.
     */
    public ?OrigCurrency $originalCurrency = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVTRAN' => 'investmentTransaction',
            'TOTAL' => 'total',
            'SUBACCTFUND' => 'subAccountFund',
            'CURRENCY' => 'currency',
            'ORIGCURRENCY' => 'originalCurrency',
        ];
    }

    /**
     * Parse property value with special handling for enum.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        if ($child->getName() === 'SUBACCTFUND') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
