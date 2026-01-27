<?php

declare(strict_types=1);

namespace Ofx\Model\Signon;

use Ofx\Aggregate\Aggregate;

/**
 * MFA Challenge aggregate.
 *
 * Contains multi-factor authentication challenge information.
 */
class MfaChallenge extends Aggregate
{
    /**
     * Challenge phrase ID.
     */
    public string $mfaphraseid;

    /**
     * Challenge phrase label (question text).
     */
    public string $mfaphraselabel;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'MFAPHRASEID' => 'mfaphraseid',
            'MFAPHRASELABEL' => 'mfaphraselabel',
        ];
    }
}
