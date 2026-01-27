<?php

declare(strict_types=1);

namespace Ofx\Model\Bank;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Common\Status;

/**
 * Statement Transaction Response aggregate.
 *
 * Wrapper for bank statement response with transaction UUID and status.
 */
class StatementTransactionResponse extends Aggregate
{
    /**
     * Transaction unique ID.
     */
    public string $transactionUniqueId;

    /**
     * Status.
     */
    public Status $status;

    /**
     * Client cookie (optional).
     */
    public ?string $clientCookie = null;

    /**
     * Statement response.
     */
    public ?StatementResponse $statementResponse = null;

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
            'STMTRS' => 'statementResponse',
        ];
    }
}
