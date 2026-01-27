<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;
use Ofx\Enum\LoanPaymentFrequency;
use ReflectionProperty;
use SimpleXMLElement;

/**
 * Loan Info aggregate.
 *
 * Contains 401k loan information.
 */
class LoanInfo extends Aggregate
{
    /**
     * Loan ID.
     */
    public string $loanId;

    /**
     * Loan description.
     */
    public ?string $loanDescription = null;

    /**
     * Initial loan balance.
     */
    public ?string $initialLoanBalance = null;

    /**
     * Loan start date.
     */
    public ?DateTimeImmutable $loanStartDate = null;

    /**
     * Current loan balance.
     */
    public ?string $currentLoanBalance = null;

    /**
     * Date/time of loan balance.
     */
    public ?DateTimeImmutable $asOfDate = null;

    /**
     * Loan rate.
     */
    public ?string $loanRate = null;

    /**
     * Loan payment amount.
     */
    public ?string $loanPaymentAmount = null;

    /**
     * Loan payment frequency.
     */
    public ?LoanPaymentFrequency $loanPaymentFrequency = null;

    /**
     * Loan payments initial.
     */
    public ?int $loanPaymentsInitial = null;

    /**
     * Loan payments remaining.
     */
    public ?int $loanPaymentsRemaining = null;

    /**
     * Loan maturity date.
     */
    public ?DateTimeImmutable $loanMaturityDate = null;

    /**
     * Total interest paid.
     */
    public ?string $loanTotalInterestPaid = null;

    /**
     * Next loan payment due date.
     */
    public ?DateTimeImmutable $loanNextPaymentDate = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'LOANID' => 'loanId',
            'LOANDESC' => 'loanDescription',
            'INITIALLOANBAL' => 'initialLoanBalance',
            'LOANSTARTDATE' => 'loanStartDate',
            'CURRENTLOANBAL' => 'currentLoanBalance',
            'DTASOF' => 'asOfDate',
            'LOANRATE' => 'loanRate',
            'LOANPMTAMT' => 'loanPaymentAmount',
            'LOANPMTFRQ' => 'loanPaymentFrequency',
            'LOANPMTSINITIAL' => 'loanPaymentsInitial',
            'LOANPMTSREMAINING' => 'loanPaymentsRemaining',
            'LOANMATURITYDATE' => 'loanMaturityDate',
            'LOANTOTINTPAID' => 'loanTotalInterestPaid',
            'LOANNEXTPMTDATE' => 'loanNextPaymentDate',
        ];
    }

    /**
     * Parse property value with special handling for enum.
     *
     * @param SimpleXMLElement $child Child element
     * @param ReflectionProperty $property Target property
     *
     * @return mixed Parsed value
     */
    protected function parsePropertyValue(SimpleXMLElement $child, ReflectionProperty $property): mixed
    {
        $tagName = $child->getName();

        if ($tagName === 'LOANPMTFRQ') {
            return LoanPaymentFrequency::from(trim((string) $child));
        }

        return parent::parsePropertyValue($child, $property);
    }
}
