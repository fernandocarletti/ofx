<?php

declare(strict_types=1);

namespace Ofx\Model\BillPay;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Email\Mail;

/**
 * Payment Mail Request aggregate.
 *
 * Request to send mail regarding a payment.
 */
class PaymentMailRequest extends Aggregate
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
