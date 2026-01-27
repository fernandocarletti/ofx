<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;

/**
 * Bill Publisher Info aggregate.
 *
 * Contains information about the bill publisher.
 */
class BillPublisherInfo extends Aggregate
{
    /**
     * Bill publisher name.
     */
    public ?string $billPublisher = null;

    /**
     * Bill ID.
     */
    public ?string $billId = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'BILLPUB' => 'billPublisher',
            'BILLID' => 'billId',
        ];
    }
}
