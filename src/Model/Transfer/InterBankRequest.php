<?php

declare(strict_types=1);

namespace Ofx\Model\Transfer;

use Ofx\Aggregate\Aggregate;

/**
 * Interbank Transfer Request aggregate.
 *
 * Request to initiate an interbank transfer.
 */
class InterBankRequest extends Aggregate
{
    /**
     * Transfer information.
     */
    public TransferInfo $transferInfo;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'XFERINFO' => 'transferInfo',
        ];
    }
}
