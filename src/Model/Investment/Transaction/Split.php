<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Model\Common\Currency;
use Ofx\Model\Common\OrigCurrency;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Split transaction aggregate.
 *
 * Stock or mutual fund split.
 */
class Split extends Aggregate
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
     * Sub-account for security.
     */
    public InvestmentSubAccount $subAccountSecurity;

    /**
     * Old units.
     */
    public string $oldUnits;

    /**
     * New units.
     */
    public string $newUnits;

    /**
     * Numerator.
     */
    public int $numerator;

    /**
     * Denominator.
     */
    public int $denominator;

    /**
     * Currency.
     */
    public ?Currency $currency = null;

    /**
     * Original currency.
     */
    public ?OrigCurrency $originalCurrency = null;

    /**
     * Fractional cash.
     */
    public ?string $fractionalCash = null;

    /**
     * Sub-account for fractional cash.
     */
    public ?InvestmentSubAccount $subAccountFund = null;

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
            'SUBACCTSEC' => 'subAccountSecurity',
            'OLDUNITS' => 'oldUnits',
            'NEWUNITS' => 'newUnits',
            'NUMERATOR' => 'numerator',
            'DENOMINATOR' => 'denominator',
            'CURRENCY' => 'currency',
            'ORIGCURRENCY' => 'originalCurrency',
            'FRACCASH' => 'fractionalCash',
            'SUBACCTFUND' => 'subAccountFund',
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

        if ($tagName === 'SUBACCTSEC' || $tagName === 'SUBACCTFUND') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        if ($tagName === 'INV401KSOURCE') {
            return Investment401kSource::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
