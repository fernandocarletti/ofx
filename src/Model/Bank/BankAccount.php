<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;
use Ofx\Enum\AccountType;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Bank Account aggregate.
 *
 * Contains bank account identification information.
 */
class BankAccount extends Aggregate
{
    /**
     * Bank routing number (ABA number in the US).
     */
    public string $routingNumber;

    /**
     * Branch identifier (optional).
     */
    public ?string $branchId = null;

    /**
     * Account number.
     */
    public string $accountId;

    /**
     * Account type (CHECKING, SAVINGS, etc.).
     */
    public AccountType $accountType;

    /**
     * Checksum for account ID (optional).
     */
    public ?string $accountKey = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BANKID' => 'routingNumber',
            'BRANCHID' => 'branchId',
            'ACCTID' => 'accountId',
            'ACCTTYPE' => 'accountType',
            'ACCTKEY' => 'accountKey',
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

        if ($tagName === 'ACCTTYPE') {
            return AccountType::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
