<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Transfer Processing Status aggregate.
 *
 * Contains the processing status of a transfer.
 */
class TransferProcessingStatus extends Aggregate
{
    /**
     * Transfer processing status code.
     * Values: WILLPROCESSON, POSTEDON, NOFUNDSON, FAILEDON, CANCELEDON.
     */
    public string $transferProcessingCode;

    /**
     * Date associated with the processing status.
     */
    public ?DateTimeImmutable $transferProcessingDate = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'XFERPRCCODE' => 'transferProcessingCode',
            'DTXFERPRC' => 'transferProcessingDate',
        ];
    }
}
