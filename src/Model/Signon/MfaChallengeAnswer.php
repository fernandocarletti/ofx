<?php

declare(strict_types=1);

namespace Ofx\Model\Signon;

use Ofx\Aggregate\Aggregate;

/**
 * MFA Challenge Answer aggregate.
 *
 * Contains multi-factor authentication challenge answer.
 */
class MfaChallengeAnswer extends Aggregate
{
    /**
     * Challenge phrase ID.
     */
    public string $mfaphraseid;

    /**
     * Challenge phrase answer.
     */
    public string $mfaphrasea;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'MFAPHRASEID' => 'mfaphraseid',
            'MFAPHRASEA' => 'mfaphrasea',
        ];
    }
}
