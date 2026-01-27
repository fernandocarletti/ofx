<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Transaction;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\Investment401kSource;
use Ofx\Enum\InvestmentSubAccount;
use Ofx\Enum\TransferAction;
use Ofx\Model\Investment\InvestmentAccount;
use Ofx\Model\Investment\Security\SecurityId;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Transfer transaction aggregate.
 *
 * Transfer of securities into or out of account.
 */
class Transfer extends Aggregate
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
     * Number of units.
     */
    public string $units;

    /**
     * Transfer action (IN or OUT).
     */
    public TransferAction $transferAction;

    /**
     * Position type.
     */
    public ?string $positionType = null;

    /**
     * Average cost basis.
     */
    public ?string $averageCostBasis = null;

    /**
     * Unit price.
     */
    public ?string $unitPrice = null;

    /**
     * Purchase date.
     */
    public ?DateTimeImmutable $purchaseDate = null;

    /**
     * Investment account from.
     */
    public ?InvestmentAccount $investmentAccountFrom = null;

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
            'UNITS' => 'units',
            'TFERACTION' => 'transferAction',
            'POSTYPE' => 'positionType',
            'AVGCOSTBASIS' => 'averageCostBasis',
            'UNITPRICE' => 'unitPrice',
            'DTPURCHASE' => 'purchaseDate',
            'INVACCTFROM' => 'investmentAccountFrom',
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

        if ($tagName === 'SUBACCTSEC') {
            return InvestmentSubAccount::from(trim((string) $child));
        }

        if ($tagName === 'TFERACTION') {
            return TransferAction::from(trim((string) $child));
        }

        if ($tagName === 'INV401KSOURCE') {
            return Investment401kSource::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
