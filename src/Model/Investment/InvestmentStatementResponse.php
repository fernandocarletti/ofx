<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Currency as CurrencyEnum;
use Ofx\Model\Investment\OpenOrder\InvestmentOpenOrderList;
use Ofx\Model\Investment\Position\InvestmentPositionList;
use Ofx\Model\Investment\Transaction\InvestmentTransactionList;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Investment Statement Response aggregate.
 *
 * Contains investment statement response data.
 */
class InvestmentStatementResponse extends Aggregate
{
    /**
     * Date/time of statement.
     */
    public DateTimeImmutable $asOfDate;

    /**
     * Default currency.
     */
    public CurrencyEnum $defaultCurrency;

    /**
     * Investment account from.
     */
    public InvestmentAccount $investmentAccountFrom;

    /**
     * Investment transaction list.
     */
    public ?InvestmentTransactionList $investmentTransactionList = null;

    /**
     * Investment position list.
     */
    public ?InvestmentPositionList $investmentPositionList = null;

    /**
     * Investment balance.
     */
    public ?InvestmentBalance $investmentBalance = null;

    /**
     * Open order list.
     */
    public ?InvestmentOpenOrderList $investmentOpenOrderList = null;

    /**
     * Marketing information.
     */
    public ?string $marketingInfo = null;

    /**
     * 401k information.
     */
    public ?Investment401k $investment401k = null;

    /**
     * 401k balance.
     */
    public ?Investment401kBalance $investment401kBalance = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DTASOF' => 'asOfDate',
            'CURDEF' => 'defaultCurrency',
            'INVACCTFROM' => 'investmentAccountFrom',
            'INVTRANLIST' => 'investmentTransactionList',
            'INVPOSLIST' => 'investmentPositionList',
            'INVBAL' => 'investmentBalance',
            'INVOOLIST' => 'investmentOpenOrderList',
            'MKTGINFO' => 'marketingInfo',
            'INV401K' => 'investment401k',
            'INV401KBAL' => 'investment401kBalance',
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
        $tagName = $child->getName();

        if ($tagName === 'CURDEF') {
            return CurrencyEnum::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
