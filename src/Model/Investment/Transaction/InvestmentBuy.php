<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\BuyType;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Model\Common\Currency;
use Ofx\Model\Common\OrigCurrency;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Investment Buy aggregate.
 *
 * Base aggregate for buy transactions.
 */
class InvestmentBuy extends Aggregate
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
     * Markup/markdown amount.
     */
    public ?string $markup = null;

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
     * Total amount.
     */
    public string $total;

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
     * Loan principal.
     */
    public ?string $loanPrincipal = null;

    /**
     * Loan interest.
     */
    public ?string $loanInterest = null;

    /**
     * 401k source.
     */
    public ?Investment401kSource $investment401kSource = null;

    /**
     * Payment date (for 401k).
     */
    public ?DateTimeImmutable $payrollDate = null;

    /**
     * Prior year contribution.
     */
    public ?bool $priorYearContribution = null;

    /**
     * Buy type.
     */
    public BuyType $buyType;

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
            'MARKUP' => 'markup',
            'COMMISSION' => 'commission',
            'TAXES' => 'taxes',
            'FEES' => 'fees',
            'LOAD' => 'load',
            'TOTAL' => 'total',
            'CURRENCY' => 'currency',
            'ORIGCURRENCY' => 'originalCurrency',
            'SUBACCTSEC' => 'subAccountSecurity',
            'SUBACCTFUND' => 'subAccountFund',
            'LOANID' => 'loanId',
            'LOANPRINCIPAL' => 'loanPrincipal',
            'LOANINTEREST' => 'loanInterest',
            'INV401KSOURCE' => 'investment401kSource',
            'DTPAYROLL' => 'payrollDate',
            'PRIORYEARCONTRIB' => 'priorYearContribution',
            'BUYTYPE' => 'buyType',
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

        if ($tagName === 'BUYTYPE') {
            return BuyType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
