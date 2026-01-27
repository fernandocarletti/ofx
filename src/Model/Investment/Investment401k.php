<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Investment 401k aggregate.
 *
 * Contains 401k account information.
 */
class Investment401k extends Aggregate
{
    /**
     * Employer name.
     */
    public ?string $employerName = null;

    /**
     * Plan ID.
     */
    public ?string $planId = null;

    /**
     * Plan join date.
     */
    public ?DateTimeImmutable $planJoinDate = null;

    /**
     * Employer contact information.
     */
    public ?string $employerContactInfo = null;

    /**
     * Broker contact information.
     */
    public ?string $brokerContactInfo = null;

    /**
     * Deferral percentage.
     */
    public ?string $deferPercentPreTax = null;

    /**
     * After-tax deferral percentage.
     */
    public ?string $deferPercentAfterTax = null;

    /**
     * Match information.
     */
    public ?MatchInfo $matchInfo = null;

    /**
     * Contribution information.
     */
    public ?ContributionInfo $contributionInfo = null;

    /**
     * Current vesting percentage.
     */
    public ?string $currentVestPercent = null;

    /**
     * Vesting information.
     */
    public ?VestInfo $vestInfo = null;

    /**
     * Loan information.
     */
    public ?LoanInfo $loanInfo = null;

    /**
     * 401k summary.
     */
    public ?Investment401kSummary $investment401kSummary = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'EMPLOYERNAME' => 'employerName',
            'PLANID' => 'planId',
            'PLANJOINDATE' => 'planJoinDate',
            'EMPLOYERCONTACTINFO' => 'employerContactInfo',
            'BROKERCONTACTINFO' => 'brokerContactInfo',
            'DEFERPCTPRETAX' => 'deferPercentPreTax',
            'DEFERPCTAFTERTAX' => 'deferPercentAfterTax',
            'MATCHINFO' => 'matchInfo',
            'CONTRIBINFO' => 'contributionInfo',
            'CURRENTVESTPCT' => 'currentVestPercent',
            'VESTINFO' => 'vestInfo',
            'LOANINFO' => 'loanInfo',
            'INV401KSUMMARY' => 'investment401kSummary',
        ];
    }
}
