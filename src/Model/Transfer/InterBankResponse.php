<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Response aggregate.
 *
 * Response to an interbank transfer request.
 */
class InterBankResponse extends Aggregate
{
    /**
     * Server-assigned reference number.
     */
    public ?string $referenceServerTransactionId = null;

    /**
     * Server-assigned transaction ID.
     */
    public string $serverTransactionId;

    /**
     * Transfer information.
     */
    public TransferInfo $transferInfo;

    /**
     * Expected posting date.
     */
    public ?DateTimeImmutable $projectedTransferDate = null;

    /**
     * Actual posting date.
     */
    public ?DateTimeImmutable $postedDate = null;

    /**
     * Transfer processing status.
     */
    public ?TransferProcessingStatus $transferProcessingStatus = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'REFSRVRTID' => 'referenceServerTransactionId',
            'SRVRTID' => 'serverTransactionId',
            'XFERINFO' => 'transferInfo',
            'DTXFERPRJ' => 'projectedTransferDate',
            'DTPOSTED' => 'postedDate',
            'XFERPRCSTS' => 'transferProcessingStatus',
        ];
    }
}
