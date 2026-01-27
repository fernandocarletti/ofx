<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use Ofx\Aggregate\Aggregate;

/**
 * Security Identifier aggregate.
 *
 * Uniquely identifies a security using a unique ID and the type of unique ID.
 * This is used throughout OFX to reference securities in transactions, positions, etc.
 */
class SecurityId extends Aggregate
{
    /**
     * Unique identifier for the security (e.g., CUSIP, SEDOL, ISIN).
     */
    public string $uniqueId;

    /**
     * Type of unique identifier (e.g., CUSIP, SEDOL, ISIN).
     */
    public string $uniqueIdType;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'UNIQUEID' => 'uniqueId',
            'UNIQUEIDTYPE' => 'uniqueIdType',
        ];
    }
}
