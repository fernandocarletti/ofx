<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Enum\SellType;
use Ofx\Model\Common\Currency;
use Ofx\Model\Common\OrigCurrency;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Investment Sell aggregate.
 *
 * Base aggregate for sell transactions.
 */
class InvestmentSell extends Aggregate
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
     * Number of units.
     */
    public string $units;

    /**
     * Unit price.
     */
    public string $unitPrice;

    /**
     * Markdown amount.
     */
    public ?string $markdown = null;

    /**
     * Commission.
     */
    public ?string $commission = null;

    /**
     * Taxes.
     */
    public ?string $taxes = null;

    /**
     * Fees.
     */
    public ?string $fees = null;

    /**
     * Load.
     */
    public ?string $load = null;

    /**
     * Withholding.
     */
    public ?string $withholding = null;

    /**
     * Tax-exempt interest.
     */
    public ?string $taxExempt = null;

    /**
     * Total amount.
     */
    public string $total;

    /**
     * Gain.
     */
    public ?string $gain = null;

    /**
     * Currency.
     */
    public ?Currency $currency = null;

    /**
     * Original currency.
     */
    public ?OrigCurrency $originalCurrency = null;

    /**
     * Sub-account for security.
     */
    public InvestmentSubAccount $subAccountSecurity;

    /**
     * Sub-account for fund.
     */
    public InvestmentSubAccount $subAccountFund;

    /**
     * Loan ID (for 401k).
     */
    public ?string $loanId = null;

    /**
     * State withholding.
     */
    public ?string $stateWithholding = null;

    /**
     * Penalty.
     */
    public ?string $penalty = null;

    /**
     * 401k source.
     */
    public ?Investment401kSource $investment401kSource = null;

    /**
     * Sell type.
     */
    public SellType $sellType;

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
            'UNITS' => 'units',
            'UNITPRICE' => 'unitPrice',
            'MARKDOWN' => 'markdown',
            'COMMISSION' => 'commission',
            'TAXES' => 'taxes',
            'FEES' => 'fees',
            'LOAD' => 'load',
            'WITHHOLDING' => 'withholding',
            'TAXEXEMPT' => 'taxExempt',
            'TOTAL' => 'total',
            'GAIN' => 'gain',
            'CURRENCY' => 'currency',
            'ORIGCURRENCY' => 'originalCurrency',
            'SUBACCTSEC' => 'subAccountSecurity',
            'SUBACCTFUND' => 'subAccountFund',
            'LOANID' => 'loanId',
            'STATEWITHHOLDING' => 'stateWithholding',
            'PENALTY' => 'penalty',
            'INV401KSOURCE' => 'investment401kSource',
            'SELLTYPE' => 'sellType',
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

        if ($tagName === 'SUBACCTSEC' || $tagName === 'SUBACCTFUND') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        if ($tagName === 'INV401KSOURCE') {
            return Investment401kSource::from(trim((string) $child));
        }

        if ($tagName === 'SELLTYPE') {
            return SellType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
