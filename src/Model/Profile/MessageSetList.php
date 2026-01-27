<?php

declare(strict_types=1);

namespace Ofx\Model\Profile;

use Ofx\Aggregate\Aggregate;

/**
 * Message Set List aggregate.
 *
 * Contains a list of message sets supported by the FI.
 */
class MessageSetList extends Aggregate
{
    /**
     * Signon message set info.
     */
    public ?MessageSetCore $signonMessageSet = null;

    /**
     * Signup message set info.
     */
    public ?MessageSetCore $signupMessageSet = null;

    /**
     * Bank message set info.
     */
    public ?MessageSetCore $bankMessageSet = null;

    /**
     * Credit card message set info.
     */
    public ?MessageSetCore $creditCardMessageSet = null;

    /**
     * Investment message set info.
     */
    public ?MessageSetCore $investmentStatementMessageSet = null;

    /**
     * Interbank funds transfer message set info.
     */
    public ?MessageSetCore $interbankTransferMessageSet = null;

    /**
     * Wire transfer message set info.
     */
    public ?MessageSetCore $wireTransferMessageSet = null;

    /**
     * Bill pay message set info.
     */
    public ?MessageSetCore $billPayMessageSet = null;

    /**
     * Email message set info.
     */
    public ?MessageSetCore $emailMessageSet = null;

    /**
     * Security list message set info.
     */
    public ?MessageSetCore $securityListMessageSet = null;

    /**
     * Profile message set info.
     */
    public ?MessageSetCore $profileMessageSet = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'SIGNONMSGSET' => 'signonMessageSet',
            'SIGNUPMSGSET' => 'signupMessageSet',
            'BANKMSGSET' => 'bankMessageSet',
            'CREDITCARDMSGSET' => 'creditCardMessageSet',
            'INVSTMTMSGSET' => 'investmentStatementMessageSet',
            'INTERXFERMSGSET' => 'interbankTransferMessageSet',
            'WIREXFERMSGSET' => 'wireTransferMessageSet',
            'BILLPAYMSGSET' => 'billPayMessageSet',
            'EMAILMSGSET' => 'emailMessageSet',
            'SECLISTMSGSET' => 'securityListMessageSet',
            'PROFMSGSET' => 'profileMessageSet',
        ];
    }
}
