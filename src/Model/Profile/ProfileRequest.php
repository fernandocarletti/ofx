<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Profile Request aggregate.
 *
 * Request for FI profile information.
 */
class ProfileRequest extends Aggregate
{
    /**
     * Client routing (e.g., "NONE", "SERVICE", "MSGSET").
     */
    public string $clientRouting;

    /**
     * Date/time of profile update.
     */
    public ?DateTimeImmutable $profileUpdateDate = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'CLIENTROUTING' => 'clientRouting',
            'DTPROFUP' => 'profileUpdateDate',
        ];
    }
}
