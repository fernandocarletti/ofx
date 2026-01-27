<?php

declare(strict_types=1);

namespace Ofx\Model\Email;

use DateTimeImmutable;
use Ofx\Aggregate\Aggregate;

/**
 * Mail aggregate.
 *
 * Contains mail message content.
 */
class Mail extends Aggregate
{
    /**
     * Sender of the message (FI or user ID).
     */
    public string $from;

    /**
     * Recipient of the message (FI or user ID).
     */
    public string $to;

    /**
     * Subject line.
     */
    public string $subject;

    /**
     * Date/time message was created.
     */
    public ?DateTimeImmutable $createdDate = null;

    /**
     * Message body.
     */
    public ?string $messageBody = null;

    /**
     * Include images flag (Y/N).
     */
    public ?bool $includeImages = null;

    /**
     * Use HTML flag (Y/N).
     */
    public ?bool $useHtml = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'FROM' => 'from',
            'TO' => 'to',
            'SUBJECT' => 'subject',
            'DTCREATED' => 'createdDate',
            'MSGBODY' => 'messageBody',
            'INCLIMAGES' => 'includeImages',
            'USEHTML' => 'useHtml',
        ];
    }
}
