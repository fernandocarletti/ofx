<?php

declare(strict_types=1);

namespace Ofx\Model\Tax;

use Ofx\Aggregate\Aggregate;

/**
 * Tax 1099-B Form aggregate.
 *
 * Proceeds from broker and barter exchange transactions (Form 1099-B).
 */
class Tax1099B extends Aggregate
{
    /**
     * Server ID for this 1099 form.
     */
    public string $serverTransactionId;

    /**
     * Tax year.
     */
    public string $taxYear;

    /**
     * Void indicator (optional).
     */
    public ?bool $void = null;

    /**
     * Corrected indicator (optional).
     */
    public ?bool $corrected = null;

    /**
     * Payer address.
     */
    public ?PayerAddress $payerAddress = null;

    /**
     * Payer ID (EIN).
     */
    public ?string $payerId = null;

    /**
     * Recipient address.
     */
    public ?RecipientAddress $recipientAddress = null;

    /**
     * Recipient ID (SSN/TIN).
     */
    public ?string $recipientId = null;

    /**
     * Recipient account number (optional).
     */
    public ?string $recipientAccount = null;

    /**
     * Stock/bond sale information (deprecated, use EXTDBINFO_V100).
     */
    public ?SecuritySalesInfo $stockBondInfo = null;

    /**
     * Extended 1099-B information.
     */
    public ?ExtendedBInfo $extendedInfo = null;

    /**
     * Federal income tax withheld (optional).
     */
    public ?string $federalTaxWithheld = null;

    /**
     * Securities summary aggregate (optional).
     */
    public ?Tax1099BSecuritiesSummary $securitiesSummary = null;

    /**
     * State tax information (optional).
     */
    public ?StateInfo $stateInfo = null;

    /**
     * Additional state information (optional).
     */
    public ?AddlStateTaxWhAgg $additionalStateInfo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'TAXYEAR' => 'taxYear',
            'VOID' => 'void',
            'CORRECTED' => 'corrected',
            'PAYERADDR' => 'payerAddress',
            'PAYERID' => 'payerId',
            'RECADDR' => 'recipientAddress',
            'RECID' => 'recipientId',
            'RECACCT' => 'recipientAccount',
            'STKBND' => 'stockBondInfo',
            'EXTDBINFO_V100' => 'extendedInfo',
            'FEDTAXWH' => 'federalTaxWithheld',
            'SECURITYSUM' => 'securitiesSummary',
            'STATEINFO' => 'stateInfo',
            'ADDLSTATEINFO' => 'additionalStateInfo',
        ];
    }
}
