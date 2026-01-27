<?php

declare(strict_types=1);

namespace Ofx\Model\Signup;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Account Info Response aggregate.
 *
 * Response containing account information.
 */
class AccountInfoResponse extends Aggregate
{
    /**
     * Date/time of this account info.
     */
    public DateTimeImmutable $accountUpdateDate;

    /**
     * All account info records.
     *
     * @var array<AccountInfo>
     */
    public array $accountInfo {
        // @phpstan-ignore return.type (listItems narrowing handled at runtime)
        get => $this->listItems;
    }

    /**
     * List of account info items.
     *
     * @var array<string>
     */
    protected static array $listProperties = [
        'ACCTINFO',
    ];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DTACCTUP' => 'accountUpdateDate',
        ];
    }
}
