<?php

declare(strict_types=1);

namespace Ofx\Model;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\BankMessagesRequestV1;
use Ofx\Model\Bank\BankMessagesResponseV1;
use Ofx\Model\BillPay\BillPayMessagesRequestV1;
use Ofx\Model\BillPay\BillPayMessagesResponseV1;
use Ofx\Model\CreditCard\CreditCardMessagesRequestV1;
use Ofx\Model\CreditCard\CreditCardMessagesResponseV1;
use Ofx\Model\Email\EmailMessagesRequestV1;
use Ofx\Model\Email\EmailMessagesResponseV1;
use Ofx\Model\Investment\InvestmentMessagesRequestV1;
use Ofx\Model\Investment\InvestmentMessagesResponseV1;
use Ofx\Model\Investment\Security\SecurityListMessagesRequestV1;
use Ofx\Model\Investment\Security\SecurityListMessagesResponseV1;
use Ofx\Model\Profile\ProfileMessagesRequestV1;
use Ofx\Model\Profile\ProfileMessagesResponseV1;
use Ofx\Model\Signon\SignonMessagesRequestV1;
use Ofx\Model\Signon\SignonMessagesResponseV1;
use Ofx\Model\Signup\SignupMessagesRequestV1;
use Ofx\Model\Signup\SignupMessagesResponseV1;
use Ofx\Model\Tax\Tax1099MessagesRequestV1;
use Ofx\Model\Tax\Tax1099MessagesResponseV1;
use Ofx\Model\Transfer\InterBankMessagesRequestV1;
use Ofx\Model\Transfer\InterBankMessagesResponseV1;
use Ofx\Model\Transfer\WireTransferMessagesRequestV1;
use Ofx\Model\Transfer\WireTransferMessagesResponseV1;

/**
 * Root OFX document aggregate.
 *
 * Contains all message sets in an OFX document (both requests and responses).
 */
class Ofx extends Aggregate
{
    // ========== Signon ==========

    /**
     * Signon request messages.
     */
    public ?SignonMessagesRequestV1 $signonMessagesRequestV1 = null;

    /**
     * Signon response messages.
     */
    public ?SignonMessagesResponseV1 $signonMessagesResponseV1 = null;

    // ========== Signup ==========

    /**
     * Signup request messages.
     */
    public ?SignupMessagesRequestV1 $signupMessagesRequestV1 = null;

    /**
     * Signup response messages.
     */
    public ?SignupMessagesResponseV1 $signupMessagesResponseV1 = null;

    // ========== Bank ==========

    /**
     * Bank request messages.
     */
    public ?BankMessagesRequestV1 $bankMessagesRequestV1 = null;

    /**
     * Bank response messages.
     */
    public ?BankMessagesResponseV1 $bankMessagesResponseV1 = null;

    // ========== Credit Card ==========

    /**
     * Credit card request messages.
     */
    public ?CreditCardMessagesRequestV1 $creditCardMessagesRequestV1 = null;

    /**
     * Credit card response messages.
     */
    public ?CreditCardMessagesResponseV1 $creditCardMessagesResponseV1 = null;

    // ========== Investment Statement ==========

    /**
     * Investment statement request messages.
     */
    public ?InvestmentMessagesRequestV1 $investmentMessagesRequestV1 = null;

    /**
     * Investment statement response messages.
     */
    public ?InvestmentMessagesResponseV1 $investmentMessagesResponseV1 = null;

    // ========== Security List ==========

    /**
     * Security list request messages.
     */
    public ?SecurityListMessagesRequestV1 $securityListMessagesRequestV1 = null;

    /**
     * Security list response messages.
     */
    public ?SecurityListMessagesResponseV1 $securityListMessagesResponseV1 = null;

    // ========== Profile ==========

    /**
     * Profile request messages.
     */
    public ?ProfileMessagesRequestV1 $profileMessagesRequestV1 = null;

    /**
     * Profile response messages.
     */
    public ?ProfileMessagesResponseV1 $profileMessagesResponseV1 = null;

    // ========== Email ==========

    /**
     * Email request messages.
     */
    public ?EmailMessagesRequestV1 $emailMessagesRequestV1 = null;

    /**
     * Email response messages.
     */
    public ?EmailMessagesResponseV1 $emailMessagesResponseV1 = null;

    // ========== Bill Pay ==========

    /**
     * Bill pay request messages.
     */
    public ?BillPayMessagesRequestV1 $billPayMessagesRequestV1 = null;

    /**
     * Bill pay response messages.
     */
    public ?BillPayMessagesResponseV1 $billPayMessagesResponseV1 = null;

    // ========== Interbank Transfer ==========

    /**
     * Interbank transfer request messages.
     */
    public ?InterBankMessagesRequestV1 $interbankTransferMessagesRequestV1 = null;

    /**
     * Interbank transfer response messages.
     */
    public ?InterBankMessagesResponseV1 $interbankTransferMessagesResponseV1 = null;

    // ========== Wire Transfer ==========

    /**
     * Wire transfer request messages.
     */
    public ?WireTransferMessagesRequestV1 $wireTransferMessagesRequestV1 = null;

    /**
     * Wire transfer response messages.
     */
    public ?WireTransferMessagesResponseV1 $wireTransferMessagesResponseV1 = null;

    // ========== Tax 1099 ==========

    /**
     * Tax 1099 request messages.
     */
    public ?Tax1099MessagesRequestV1 $tax1099MessagesRequestV1 = null;

    /**
     * Tax 1099 response messages.
     */
    public ?Tax1099MessagesResponseV1 $tax1099MessagesResponseV1 = null;

    // ========== Convenience Methods ==========

    /**
     * Check if this is a request document.
     *
     * @return bool True if any request message set is present
     */
    public function isRequest(): bool
    {
        return $this->signonMessagesRequestV1 !== null
            || $this->signupMessagesRequestV1 !== null
            || $this->bankMessagesRequestV1 !== null
            || $this->creditCardMessagesRequestV1 !== null
            || $this->investmentMessagesRequestV1 !== null
            || $this->securityListMessagesRequestV1 !== null
            || $this->profileMessagesRequestV1 !== null
            || $this->emailMessagesRequestV1 !== null
            || $this->billPayMessagesRequestV1 !== null
            || $this->interbankTransferMessagesRequestV1 !== null
            || $this->wireTransferMessagesRequestV1 !== null
            || $this->tax1099MessagesRequestV1 !== null;
    }

    /**
     * Check if this is a response document.
     *
     * @return bool True if any response message set is present
     */
    public function isResponse(): bool
    {
        return $this->signonMessagesResponseV1 !== null
            || $this->signupMessagesResponseV1 !== null
            || $this->bankMessagesResponseV1 !== null
            || $this->creditCardMessagesResponseV1 !== null
            || $this->investmentMessagesResponseV1 !== null
            || $this->securityListMessagesResponseV1 !== null
            || $this->profileMessagesResponseV1 !== null
            || $this->emailMessagesResponseV1 !== null
            || $this->billPayMessagesResponseV1 !== null
            || $this->interbankTransferMessagesResponseV1 !== null
            || $this->wireTransferMessagesResponseV1 !== null
            || $this->tax1099MessagesResponseV1 !== null;
    }

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            // Signon
            'SIGNONMSGSRQV1' => 'signonMessagesRequestV1',
            'SIGNONMSGSRSV1' => 'signonMessagesResponseV1',
            // Signup
            'SIGNUPMSGSRQV1' => 'signupMessagesRequestV1',
            'SIGNUPMSGSRSV1' => 'signupMessagesResponseV1',
            // Bank
            'BANKMSGSRQV1' => 'bankMessagesRequestV1',
            'BANKMSGSRSV1' => 'bankMessagesResponseV1',
            // Credit Card
            'CREDITCARDMSGSRQV1' => 'creditCardMessagesRequestV1',
            'CREDITCARDMSGSRSV1' => 'creditCardMessagesResponseV1',
            // Investment
            'INVSTMTMSGSRQV1' => 'investmentMessagesRequestV1',
            'INVSTMTMSGSRSV1' => 'investmentMessagesResponseV1',
            // Security List
            'SECLISTMSGSRQV1' => 'securityListMessagesRequestV1',
            'SECLISTMSGSRSV1' => 'securityListMessagesResponseV1',
            // Profile
            'PROFMSGSRQV1' => 'profileMessagesRequestV1',
            'PROFMSGSRSV1' => 'profileMessagesResponseV1',
            // Email
            'EMAILMSGSRQV1' => 'emailMessagesRequestV1',
            'EMAILMSGSRSV1' => 'emailMessagesResponseV1',
            // Bill Pay
            'BILLPAYMSGSRQV1' => 'billPayMessagesRequestV1',
            'BILLPAYMSGSRSV1' => 'billPayMessagesResponseV1',
            // Interbank Transfer
            'INTERXFERMSGSRQV1' => 'interbankTransferMessagesRequestV1',
            'INTERXFERMSGSRSV1' => 'interbankTransferMessagesResponseV1',
            // Wire Transfer
            'WIREXFERMSGSRQV1' => 'wireTransferMessagesRequestV1',
            'WIREXFERMSGSRSV1' => 'wireTransferMessagesResponseV1',
            // Tax 1099
            'TAX1099MSGSRQV1' => 'tax1099MessagesRequestV1',
            'TAX1099MSGSRSV1' => 'tax1099MessagesResponseV1',
        ];
    }
}
