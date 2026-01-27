<?php

declare(strict_types=1);

namespace Ofx\Model\Signup;

use Ofx\Aggregate\Aggregate;
use Ofx\Model\Bank\BankAccountInfo;
use Ofx\Model\Bank\CreditCardAccountInfo;
use Ofx\Model\BillPay\BillPayAccountInfo;
use Ofx\Model\Investment\InvestmentAccountInfo;

/**
 * Account Info aggregate.
 *
 * Contains information about an account that is available to the user.
 */
class AccountInfo extends Aggregate
{
    /**
     * Description of the account.
     */
    public ?string $description = null;

    /**
     * Phone number associated with account.
     */
    public ?string $phone = null;

    /**
     * Bank account information.
     */
    public ?BankAccountInfo $bankAccountInfo = null;

    /**
     * Credit card account information.
     */
    public ?CreditCardAccountInfo $creditCardAccountInfo = null;

    /**
     * Investment account information.
     */
    public ?InvestmentAccountInfo $investmentAccountInfo = null;

    /**
     * Bill pay account information.
     */
    public ?BillPayAccountInfo $billPayAccountInfo = null;

    /**
     * Get tag name to property name mappings.
     *
     * @return array<string, string>
     */
    protected function getTagMappings(): array
    {
        return [
            'DESC' => 'description',
            'PHONE' => 'phone',
            'BANKACCTINFO' => 'bankAccountInfo',
            'CCACCTINFO' => 'creditCardAccountInfo',
            'INVACCTINFO' => 'investmentAccountInfo',
            'BPACCTINFO' => 'billPayAccountInfo',
        ];
    }
}
