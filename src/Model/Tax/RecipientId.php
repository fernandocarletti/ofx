<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Recipient ID aggregate.
 *
 * Identification information for the recipient on tax forms.
 */
class RecipientId extends Aggregate
{
    /**
     * Social Security Number (SSN) (optional).
     * Mutually exclusive with TIN.
     */
    public ?string $socialSecurityNumber = null;

    /**
     * Taxpayer Identification Number (TIN) (optional).
     * Mutually exclusive with SSN.
     */
    public ?string $taxpayerIdentificationNumber = null;

    /**
     * Mutual exclusion: SSN or TIN.
     *
     * @var array<array<string>>
     */
    protected static array $requiredMutexes = [
        ['socialSecurityNumber', 'taxpayerIdentificationNumber'],
    ];

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SSN' => 'socialSecurityNumber',
            'TIN' => 'taxpayerIdentificationNumber',
        ];
    }
}
