<?php

declare(strict_types=1);

namespace Ofx\Model\Signup;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Account Info Request aggregate.
 *
 * Request for account information.
 */
class AccountInfoRequest extends Aggregate
{
    /**
     * Date/time client last updated account info.
     */
    public DateTimeImmutable $accountUpdateDate;

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
