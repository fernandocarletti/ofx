<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Modification Response aggregate.
 *
 * Response to an interbank transfer modification request.
 */
class InterBankModResponse extends Aggregate
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
            'XFERPRCSTS' => 'transferProcessingStatus',
        ];
    }
}
