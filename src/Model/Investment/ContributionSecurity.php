<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Investment\Security\SecurityId;

/**
 * Contribution Security aggregate.
 *
 * Contains security-specific contribution information.
 */
class ContributionSecurity extends Aggregate
{
    /**
     * Security ID.
     */
    public SecurityId $securityId;

    /**
     * Pre-tax contribution percentage.
     */
    public ?string $preTaxContributionPercent = null;

    /**
     * Pre-tax contribution amount.
     */
    public ?string $preTaxContributionAmount = null;

    /**
     * After-tax contribution percentage.
     */
    public ?string $afterTaxContributionPercent = null;

    /**
     * After-tax contribution amount.
     */
    public ?string $afterTaxContributionAmount = null;

    /**
     * Match contribution percentage.
     */
    public ?string $matchContributionPercent = null;

    /**
     * Match contribution amount.
     */
    public ?string $matchContributionAmount = null;

    /**
     * Profit sharing contribution percentage.
     */
    public ?string $profitSharingContributionPercent = null;

    /**
     * Profit sharing contribution amount.
     */
    public ?string $profitSharingContributionAmount = null;

    /**
     * Rollover contribution percentage.
     */
    public ?string $rolloverContributionPercent = null;

    /**
     * Rollover contribution amount.
     */
    public ?string $rolloverContributionAmount = null;

    /**
     * Other vested contribution percentage.
     */
    public ?string $otherVestedPercent = null;

    /**
     * Other vested contribution amount.
     */
    public ?string $otherVestedAmount = null;

    /**
     * Other non-vested contribution percentage.
     */
    public ?string $otherNonVestedPercent = null;

    /**
     * Other non-vested contribution amount.
     */
    public ?string $otherNonVestedAmount = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SECID' => 'securityId',
            'PRETAXCONTRIBPCT' => 'preTaxContributionPercent',
            'PRETAXCONTRIBAMT' => 'preTaxContributionAmount',
            'AFTERTAXCONTRIBPCT' => 'afterTaxContributionPercent',
            'AFTERTAXCONTRIBAMT' => 'afterTaxContributionAmount',
            'MATCHCONTRIBPCT' => 'matchContributionPercent',
            'MATCHCONTRIBAMT' => 'matchContributionAmount',
            'PROFITSHARINGCONTRIBPCT' => 'profitSharingContributionPercent',
            'PROFITSHARINGCONTRIBAMT' => 'profitSharingContributionAmount',
            'ROLLOVERCONTRIBPCT' => 'rolloverContributionPercent',
            'ROLLOVERCONTRIBAMT' => 'rolloverContributionAmount',
            'OTHERVESTPCT' => 'otherVestedPercent',
            'OTHERVESTAMT' => 'otherVestedAmount',
            'OTHERNONVESTPCT' => 'otherNonVestedPercent',
            'OTHERNONVESTAMT' => 'otherNonVestedAmount',
        ];
    }
}
