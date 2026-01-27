<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security List Response aggregate.
 *
 * Response containing security list information.
 */
class SecurityListResponse extends Aggregate
{
    /**
     * Security list.
     */
    public ?SecurityList $securityList = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECLIST' => 'securityList',
        ];
    }
}
