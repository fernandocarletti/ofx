<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Email\Mail;

/**
 * Payment Mail Response aggregate.
 *
 * Response to a payment mail request.
 */
class PaymentMailResponse extends Aggregate
{
    /**
     * Server-assigned transaction ID of payment.
     */
    public ?string $serverTransactionId = null;

    /**
     * Mail content.
     */
    public Mail $mail;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SRVRTID' => 'serverTransactionId',
            'MAIL' => 'mail',
        ];
    }
}
