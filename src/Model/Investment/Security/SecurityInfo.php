<?php

declare(strict_types=1);

namespace Ofx\Model\Investment\Security;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Currency;

/**
 * Security Info aggregate.
 *
 * Base security information that is common to all security types.
 * Contains identifying information, pricing, and other general details.
 */
class SecurityInfo extends Aggregate
{
    /**
     * Security identifier.
     */
    public SecurityId $securityId;

    /**
     * Full name of the security.
     */
    public string $securityName;

    /**
     * Ticker symbol.
     */
    public ?string $ticker = null;

    /**
     * FI-assigned security ID.
     */
    public ?string $financialInstitutionId = null;

    /**
     * Security rating.
     */
    public ?string $rating = null;

    /**
     * Unit price.
     */
    public ?string $unitPrice = null;

    /**
     * Date of unit price.
     */
    public ?DateTimeImmutable $asOfDate = null;

    /**
     * Currency information.
     */
    public ?Currency $currency = null;

    /**
     * Memo or description.
     */
    public ?string $memo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECID' => 'securityId',
            'SECNAME' => 'securityName',
            'TICKER' => 'ticker',
            'FIID' => 'financialInstitutionId',
            'RATING' => 'rating',
            'UNITPRICE' => 'unitPrice',
            'DTASOF' => 'asOfDate',
            'CURRENCY' => 'currency',
            'MEMO' => 'memo',
        ];
    }
}
