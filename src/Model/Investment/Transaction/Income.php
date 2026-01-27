<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\IncomeType;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Model\Common\Currency;
use Ofx\Model\Common\OrigCurrency;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Income transaction aggregate.
 *
 * Investment income transaction (dividends, interest, etc.).
 */
class Income extends Aggregate
{
    /**
     * Investment transaction details.
     */
    public InvestmentTransaction $investmentTransaction;

    /**
     * Security ID.
     */
    public SecurityId $securityId;

    /**
     * Income type.
     */
    public IncomeType $incomeType;

    /**
     * Total amount.
     */
    public string $total;

    /**
     * Sub-account for security.
     */
    public InvestmentSubAccount $subAccountSecurity;

    /**
     * Sub-account for fund.
     */
    public InvestmentSubAccount $subAccountFund;

    /**
     * Tax-exempt indicator.
     */
    public ?bool $taxExempt = null;

    /**
     * Withholding.
     */
    public ?string $withholding = null;

    /**
     * Currency.
     */
    public ?Currency $currency = null;

    /**
     * Original currency.
     */
    public ?OrigCurrency $originalCurrency = null;

    /**
     * 401k source.
     */
    public ?Investment401kSource $investment401kSource = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'INVTRAN' => 'investmentTransaction',
            'SECID' => 'securityId',
            'INCOMETYPE' => 'incomeType',
            'TOTAL' => 'total',
            'SUBACCTSEC' => 'subAccountSecurity',
            'SUBACCTFUND' => 'subAccountFund',
            'TAXEXEMPT' => 'taxExempt',
            'WITHHOLDING' => 'withholding',
            'CURRENCY' => 'currency',
            'ORIGCURRENCY' => 'originalCurrency',
            'INV401KSOURCE' => 'investment401kSource',
        ];
    }

    /**
     * Parse property value with special handling for enums.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        $tagName = $child->getName();

        if ($tagName === 'INCOMETYPE') {
            return IncomeType::from(trim((string) $child));
        }

        if ($tagName === 'SUBACCTSEC' || $tagName === 'SUBACCTFUND') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        if ($tagName === 'INV401KSOURCE') {
            return Investment401kSource::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
