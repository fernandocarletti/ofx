<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-B Securities Summary aggregate.
 *
 * Summary information for securities reported on 1099-B.
 */
class Tax1099BSecuritiesSummary extends Aggregate
{
    /**
     * Short-term basis reported to IRS (optional).
     */
    public ?string $shortTermCapGainBasisReportedToIrs = null;

    /**
     * Short-term basis not reported to IRS (optional).
     */
    public ?string $shortTermCapGainBasisNotReportedToIrs = null;

    /**
     * Long-term basis reported to IRS (optional).
     */
    public ?string $longTermCapGainBasisReportedToIrs = null;

    /**
     * Long-term basis not reported to IRS (optional).
     */
    public ?string $longTermCapGainBasisNotReportedToIrs = null;

    /**
     * Undetermined basis (optional).
     */
    public ?string $undeterminedBasis = null;

    /**
     * Aggregate profit or loss (optional).
     */
    public ?string $aggregateProfitOrLoss = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'STCGBASISRPTDTOIRS' => 'shortTermCapGainBasisReportedToIrs',
            'STCGBASISNOTRPTDTOIRS' => 'shortTermCapGainBasisNotReportedToIrs',
            'LTCGBASISRPTDTOIRS' => 'longTermCapGainBasisReportedToIrs',
            'LTCGBASISNOTRPTDTOIRS' => 'longTermCapGainBasisNotReportedToIrs',
            'UNDETERMBASIS' => 'undeterminedBasis',
            'AGGPROFLOSS' => 'aggregateProfitOrLoss',
        ];
    }
}
