<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security Request aggregate.
 *
 * Used to request information about a specific security.
 */
class SecurityRequest extends Aggregate
{
    /**
     * Security identifier.
     */
    public SecurityId $securityId;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECID' => 'securityId',
        ];
    }
}
