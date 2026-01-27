<?php

declare(strict_types=1);

namespace Ofx\Model\Investment;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Investment Statement Transaction Response wrapper aggregate.
 *
 * Wraps investment statement response with transaction ID and status.
 */
class InvestmentStatementTransactionResponse extends Aggregate
{
    /**
     * Client-assigned globally unique transaction ID.
     */
    public string $transactionUniqueId;

    /**
     * Status of the transaction.
     */
    public Status $status;

    /**
     * Client ID (optional).
     */
    public ?string $clientCookie = null;

    /**
     * OFX extension (optional).
     */
    public ?string $ofxExtension = null;

    /**
     * Investment statement response.
     */
    public ?InvestmentStatementResponse $investmentStatementResponse = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'TRNUID' => 'transactionUniqueId',
            'STATUS' => 'status',
            'CLTCOOKIE' => 'clientCookie',
            'OFXEXTENSION' => 'ofxExtension',
            'INVSTMTRS' => 'investmentStatementResponse',
        ];
    }
}
