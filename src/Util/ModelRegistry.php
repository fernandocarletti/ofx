<?php

declare(strict_types=1);

namespace Ofx\Util;

use Ofx\Model;

/**
 * Registry mapping OFX tag names to model classes.
 *
 * This registry is used by the parser to instantiate the correct
 * model class for each OFX aggregate element.
 */
final class ModelRegistry
{
    /**
     * Mapping of OFX tag names to fully qualified class names.
     *
     * @var array<string, class-string>
     */
    private static array $models = [];

    /**
     * Flag indicating if the registry has been initialized.
     */
    private static bool $initialized = false;

    /**
     * Get the model class for an OFX tag name.
     *
     * @param string $tagName OFX tag name (case-insensitive)
     *
     * @return class-string|null Model class name or null if not found
     */
    public static function get(string $tagName): ?string
    {
        self::ensureInitialized();

        $tagName = strtoupper($tagName);

        return self::$models[$tagName] ?? null;
    }

    /**
     * Register a model class for an OFX tag name.
     *
     * @param string $tagName OFX tag name
     * @param class-string $className Model class name
     */
    public static function register(string $tagName, string $className): void
    {
        self::$models[strtoupper($tagName)] = $className;
    }

    /**
     * Check if a tag name has a registered model.
     *
     * @param string $tagName OFX tag name
     *
     * @return bool True if model exists
     */
    public static function has(string $tagName): bool
    {
        self::ensureInitialized();

        return isset(self::$models[strtoupper($tagName)]);
    }

    /**
     * Initialize the registry with all known models.
     */
    private static function ensureInitialized(): void
    {
        if (self::$initialized) {
            return;
        }

        self::registerModels();
        self::$initialized = true;
    }

    /**
     * Register all OFX models.
     */
    private static function registerModels(): void
    {
        // Root
        self::register('OFX', Model\Ofx::class);

        // Signon
        self::register('SIGNONMSGSRQV1', Model\Signon\SignonMessagesRequestV1::class);
        self::register('SIGNONMSGSRSV1', Model\Signon\SignonMessagesResponseV1::class);
        self::register('SONRQ', Model\Signon\SignonRequest::class);
        self::register('SONRS', Model\Signon\SignonResponse::class);
        self::register('FI', Model\Signon\FinancialInstitution::class);
        self::register('STATUS', Model\Common\Status::class);
        self::register('MFACHALLENGE', Model\Signon\MfaChallenge::class);
        self::register('MFACHALLENGEA', Model\Signon\MfaChallengeAnswer::class);

        // Common
        self::register('BAL', Model\Common\Balance::class);
        self::register('CURRENCY', Model\Common\Currency::class);
        self::register('ORIGCURRENCY', Model\Common\OrigCurrency::class);

        // Bank
        self::register('BANKMSGSRQV1', Model\Bank\BankMessagesRequestV1::class);
        self::register('BANKMSGSRSV1', Model\Bank\BankMessagesResponseV1::class);
        self::register('STMTTRNRQ', Model\Bank\StatementTransactionRequest::class);
        self::register('STMTTRNRS', Model\Bank\StatementTransactionResponse::class);
        self::register('STMTRQ', Model\Bank\StatementRequest::class);
        self::register('STMTRS', Model\Bank\StatementResponse::class);
        self::register('BANKACCTFROM', Model\Bank\BankAccount::class);
        self::register('BANKACCTTO', Model\Bank\BankAccount::class);
        self::register('BANKACCTINFO', Model\Bank\BankAccountInfo::class);
        self::register('CCACCTFROM', Model\Bank\CreditCardAccount::class);
        self::register('CCACCTTO', Model\Bank\CreditCardAccount::class);
        self::register('CCACCTINFO', Model\Bank\CreditCardAccountInfo::class);
        self::register('BANKTRANLIST', Model\Bank\BankTransactionList::class);
        self::register('STMTTRN', Model\Bank\Transaction::class);
        self::register('LEDGERBAL', Model\Bank\LedgerBalance::class);
        self::register('AVAILBAL', Model\Bank\AvailableBalance::class);
        self::register('BALLIST', Model\Bank\BalanceList::class);
        self::register('PAYEE', Model\Bank\Payee::class);
        self::register('INCTRAN', Model\Bank\IncludeTransactions::class);
        self::register('REWARDINFO', Model\Bank\RewardInfo::class);

        // Credit Card
        self::register('CREDITCARDMSGSRQV1', Model\CreditCard\CreditCardMessagesRequestV1::class);
        self::register('CREDITCARDMSGSRSV1', Model\CreditCard\CreditCardMessagesResponseV1::class);
        self::register('CCSTMTTRNRQ', Model\CreditCard\CreditCardStatementTransactionRequest::class);
        self::register('CCSTMTTRNRS', Model\CreditCard\CreditCardStatementTransactionResponse::class);
        self::register('CCSTMTRQ', Model\CreditCard\CreditCardStatementRequest::class);
        self::register('CCSTMTRS', Model\CreditCard\CreditCardStatementResponse::class);

        // Investment
        self::register('INVSTMTMSGSRQV1', Model\Investment\InvestmentMessagesRequestV1::class);
        self::register('INVSTMTMSGSRSV1', Model\Investment\InvestmentMessagesResponseV1::class);
        self::register('INVSTMTTRNRQ', Model\Investment\InvestmentStatementTransactionRequest::class);
        self::register('INVSTMTTRNRS', Model\Investment\InvestmentStatementTransactionResponse::class);
        self::register('INVSTMTRQ', Model\Investment\InvestmentStatementRequest::class);
        self::register('INVSTMTRS', Model\Investment\InvestmentStatementResponse::class);
        self::register('INVACCTFROM', Model\Investment\InvestmentAccount::class);
        self::register('INVACCTTO', Model\Investment\InvestmentAccount::class);
        self::register('INVACCTINFO', Model\Investment\InvestmentAccountInfo::class);
        self::register('INCPOS', Model\Investment\IncludePositions::class);
        self::register('INVTRANLIST', Model\Investment\Transaction\InvestmentTransactionList::class);
        self::register('INVBANKTRAN', Model\Investment\Transaction\InvestmentBankTransaction::class);
        self::register('INVTRAN', Model\Investment\Transaction\InvestmentTransaction::class);
        self::register('INVBUY', Model\Investment\Transaction\InvestmentBuy::class);
        self::register('INVSELL', Model\Investment\Transaction\InvestmentSell::class);
        self::register('BUYDEBT', Model\Investment\Transaction\BuyDebt::class);
        self::register('BUYMF', Model\Investment\Transaction\BuyMutualFund::class);
        self::register('BUYOPT', Model\Investment\Transaction\BuyOption::class);
        self::register('BUYOTHER', Model\Investment\Transaction\BuyOther::class);
        self::register('BUYSTOCK', Model\Investment\Transaction\BuyStock::class);
        self::register('SELLDEBT', Model\Investment\Transaction\SellDebt::class);
        self::register('SELLMF', Model\Investment\Transaction\SellMutualFund::class);
        self::register('SELLOPT', Model\Investment\Transaction\SellOption::class);
        self::register('SELLOTHER', Model\Investment\Transaction\SellOther::class);
        self::register('SELLSTOCK', Model\Investment\Transaction\SellStock::class);
        self::register('CLOSUREOPT', Model\Investment\Transaction\ClosureOption::class);
        self::register('INCOME', Model\Investment\Transaction\Income::class);
        self::register('INVEXPENSE', Model\Investment\Transaction\InvestmentExpense::class);
        self::register('JRNLFUND', Model\Investment\Transaction\JournalFund::class);
        self::register('JRNLSEC', Model\Investment\Transaction\JournalSecurity::class);
        self::register('MARGININTEREST', Model\Investment\Transaction\MarginInterest::class);
        self::register('REINVEST', Model\Investment\Transaction\Reinvest::class);
        self::register('RETOFCAP', Model\Investment\Transaction\ReturnOfCapital::class);
        self::register('SPLIT', Model\Investment\Transaction\Split::class);
        self::register('TRANSFER', Model\Investment\Transaction\Transfer::class);
        self::register('INVBAL', Model\Investment\InvestmentBalance::class);
        self::register('INV401KBAL', Model\Investment\Investment401kBalance::class);
        self::register('INV401K', Model\Investment\Investment401k::class);
        self::register('INV401KSUMMARY', Model\Investment\Investment401kSummary::class);
        self::register('CONTRIBUTIONS', Model\Investment\Contributions::class);
        self::register('WITHDRAWALS', Model\Investment\Withdrawals::class);
        self::register('EARNINGS', Model\Investment\Earnings::class);
        self::register('YEARTODATE', Model\Investment\YearToDate::class);
        self::register('INCEPTODATE', Model\Investment\InceptionToDate::class);
        self::register('PERIODTODATE', Model\Investment\PeriodToDate::class);
        self::register('MATCHINFO', Model\Investment\MatchInfo::class);
        self::register('CONTRIBINFO', Model\Investment\ContributionInfo::class);
        self::register('CONTRIBSECURITY', Model\Investment\ContributionSecurity::class);
        self::register('VESTINFO', Model\Investment\VestInfo::class);
        self::register('LOANINFO', Model\Investment\LoanInfo::class);

        // Investment Positions
        self::register('INVPOSLIST', Model\Investment\Position\InvestmentPositionList::class);
        self::register('INVPOS', Model\Investment\Position\InvestmentPosition::class);
        self::register('POSDEBT', Model\Investment\Position\PositionDebt::class);
        self::register('POSMF', Model\Investment\Position\PositionMutualFund::class);
        self::register('POSOPT', Model\Investment\Position\PositionOption::class);
        self::register('POSOTHER', Model\Investment\Position\PositionOther::class);
        self::register('POSSTOCK', Model\Investment\Position\PositionStock::class);

        // Investment Securities
        self::register('SECLISTMSGSRQV1', Model\Investment\Security\SecurityListMessagesRequestV1::class);
        self::register('SECLISTMSGSRSV1', Model\Investment\Security\SecurityListMessagesResponseV1::class);
        self::register('SECLIST', Model\Investment\Security\SecurityList::class);
        self::register('SECLISTTRNRQ', Model\Investment\Security\SecurityListTransactionRequest::class);
        self::register('SECLISTTRNRS', Model\Investment\Security\SecurityListTransactionResponse::class);
        self::register('SECLISTRQ', Model\Investment\Security\SecurityListRequest::class);
        self::register('SECLISTRS', Model\Investment\Security\SecurityListResponse::class);
        self::register('SECID', Model\Investment\Security\SecurityId::class);
        self::register('SECRQ', Model\Investment\Security\SecurityRequest::class);
        self::register('SECINFO', Model\Investment\Security\SecurityInfo::class);
        self::register('DEBTINFO', Model\Investment\Security\DebtInfo::class);
        self::register('MFINFO', Model\Investment\Security\MutualFundInfo::class);
        self::register('MFASSETCLASS', Model\Investment\Security\MutualFundAssetClass::class);
        self::register('FIMFASSETCLASS', Model\Investment\Security\FiMutualFundAssetClass::class);
        self::register('PORTION', Model\Investment\Security\Portion::class);
        self::register('FIPORTION', Model\Investment\Security\FiPortion::class);
        self::register('OPTINFO', Model\Investment\Security\OptionInfo::class);
        self::register('OTHERINFO', Model\Investment\Security\OtherInfo::class);
        self::register('STOCKINFO', Model\Investment\Security\StockInfo::class);

        // Investment Open Orders
        self::register('INVOOLIST', Model\Investment\OpenOrder\InvestmentOpenOrderList::class);
        self::register('OO', Model\Investment\OpenOrder\OpenOrder::class);
        self::register('OOBUYDEBT', Model\Investment\OpenOrder\OpenOrderBuyDebt::class);
        self::register('OOBUYMF', Model\Investment\OpenOrder\OpenOrderBuyMutualFund::class);
        self::register('OOBUYOPT', Model\Investment\OpenOrder\OpenOrderBuyOption::class);
        self::register('OOBUYOTHER', Model\Investment\OpenOrder\OpenOrderBuyOther::class);
        self::register('OOBUYSTOCK', Model\Investment\OpenOrder\OpenOrderBuyStock::class);
        self::register('OOSELLDEBT', Model\Investment\OpenOrder\OpenOrderSellDebt::class);
        self::register('OOSELLMF', Model\Investment\OpenOrder\OpenOrderSellMutualFund::class);
        self::register('OOSELLOPT', Model\Investment\OpenOrder\OpenOrderSellOption::class);
        self::register('OOSELLOTHER', Model\Investment\OpenOrder\OpenOrderSellOther::class);
        self::register('OOSELLSTOCK', Model\Investment\OpenOrder\OpenOrderSellStock::class);
        self::register('SWITCHMF', Model\Investment\OpenOrder\SwitchMutualFund::class);

        // Signup
        self::register('SIGNUPMSGSRQV1', Model\Signup\SignupMessagesRequestV1::class);
        self::register('SIGNUPMSGSRSV1', Model\Signup\SignupMessagesResponseV1::class);
        self::register('ACCTINFOTRNRQ', Model\Signup\AccountInfoTransactionRequest::class);
        self::register('ACCTINFOTRNRS', Model\Signup\AccountInfoTransactionResponse::class);
        self::register('ACCTINFORQ', Model\Signup\AccountInfoRequest::class);
        self::register('ACCTINFORS', Model\Signup\AccountInfoResponse::class);
        self::register('ACCTINFO', Model\Signup\AccountInfo::class);

        // Profile
        self::register('PROFMSGSRQV1', Model\Profile\ProfileMessagesRequestV1::class);
        self::register('PROFMSGSRSV1', Model\Profile\ProfileMessagesResponseV1::class);
        self::register('PROFTRNRQ', Model\Profile\ProfileTransactionRequest::class);
        self::register('PROFTRNRS', Model\Profile\ProfileTransactionResponse::class);
        self::register('PROFRQ', Model\Profile\ProfileRequest::class);
        self::register('PROFRS', Model\Profile\ProfileResponse::class);
        self::register('MSGSETCORE', Model\Profile\MessageSetCore::class);
        self::register('MSGSETLIST', Model\Profile\MessageSetList::class);

        // Email
        self::register('EMAILMSGSRQV1', Model\Email\EmailMessagesRequestV1::class);
        self::register('EMAILMSGSRSV1', Model\Email\EmailMessagesResponseV1::class);
        self::register('MAILTRNRQ', Model\Email\MailTransactionRequest::class);
        self::register('MAILTRNRS', Model\Email\MailTransactionResponse::class);
        self::register('MAILRQ', Model\Email\MailRequest::class);
        self::register('MAILRS', Model\Email\MailResponse::class);
        self::register('MAIL', Model\Email\Mail::class);
        self::register('GETMIMETRNRQ', Model\Email\GetMimeTransactionRequest::class);
        self::register('GETMIMETRNRS', Model\Email\GetMimeTransactionResponse::class);
        self::register('GETMIMERQ', Model\Email\GetMimeRequest::class);
        self::register('GETMIMERS', Model\Email\GetMimeResponse::class);
        self::register('INCMAIL', Model\Email\IncludeMail::class);
        self::register('INCHTML', Model\Email\IncludeHtml::class);

        // Bill Pay
        self::register('BILLPAYMSGSRQV1', Model\BillPay\BillPayMessagesRequestV1::class);
        self::register('BILLPAYMSGSRSV1', Model\BillPay\BillPayMessagesResponseV1::class);
        self::register('BPACCTINFO', Model\BillPay\BillPayAccountInfo::class);
        self::register('BILLPUBINFO', Model\BillPay\BillPublisherInfo::class);
        self::register('PMTINFO', Model\BillPay\PaymentInfo::class);
        self::register('EXTDPMT', Model\BillPay\ExtendedPayment::class);
        self::register('EXTDPMTINV', Model\BillPay\ExtendedPaymentInvoice::class);
        self::register('EXTDPAYEE', Model\BillPay\ExtendedPayee::class);
        self::register('INVOICE', Model\BillPay\Invoice::class);
        self::register('DISCOUNT', Model\BillPay\Discount::class);
        self::register('ADJUSTMENT', Model\BillPay\Adjustment::class);
        self::register('LINEITEM', Model\BillPay\LineItem::class);
        self::register('PMTPRCSTS', Model\BillPay\PaymentProcessingStatus::class);
        self::register('PMTTRNRQ', Model\BillPay\PaymentTransactionRequest::class);
        self::register('PMTTRNRS', Model\BillPay\PaymentTransactionResponse::class);
        self::register('PMTRQ', Model\BillPay\PaymentRequest::class);
        self::register('PMTRS', Model\BillPay\PaymentResponse::class);
        self::register('PMTMODRQ', Model\BillPay\PaymentModRequest::class);
        self::register('PMTMODRS', Model\BillPay\PaymentModResponse::class);
        self::register('PMTCANCRQ', Model\BillPay\PaymentCancelRequest::class);
        self::register('PMTCANCRS', Model\BillPay\PaymentCancelResponse::class);
        self::register('PMTINQTRNRQ', Model\BillPay\PaymentInquiryTransactionRequest::class);
        self::register('PMTINQTRNRS', Model\BillPay\PaymentInquiryTransactionResponse::class);
        self::register('PMTINQRQ', Model\BillPay\PaymentInquiryRequest::class);
        self::register('PMTINQRS', Model\BillPay\PaymentInquiryResponse::class);
        self::register('PAYEETRNRQ', Model\BillPay\PayeeTransactionRequest::class);
        self::register('PAYEETRNRS', Model\BillPay\PayeeTransactionResponse::class);
        self::register('PAYEERQ', Model\BillPay\PayeeRequest::class);
        self::register('PAYEERS', Model\BillPay\PayeeResponse::class);
        self::register('PAYEEMODRQ', Model\BillPay\PayeeModRequest::class);
        self::register('PAYEEMODRS', Model\BillPay\PayeeModResponse::class);
        self::register('PAYEEDELRQ', Model\BillPay\PayeeDeleteRequest::class);
        self::register('PAYEEDELRS', Model\BillPay\PayeeDeleteResponse::class);
        self::register('PMTMAILTRNRQ', Model\BillPay\PaymentMailTransactionRequest::class);
        self::register('PMTMAILTRNRS', Model\BillPay\PaymentMailTransactionResponse::class);
        self::register('PMTMAILRQ', Model\BillPay\PaymentMailRequest::class);
        self::register('PMTMAILRS', Model\BillPay\PaymentMailResponse::class);

        // Transfer - InterBank
        self::register('INTERXFERMSGSRQV1', Model\Transfer\InterBankMessagesRequestV1::class);
        self::register('INTERXFERMSGSRSV1', Model\Transfer\InterBankMessagesResponseV1::class);
        self::register('INTERTRNRQ', Model\Transfer\InterBankTransactionRequest::class);
        self::register('INTERTRNRS', Model\Transfer\InterBankTransactionResponse::class);
        self::register('INTERRQ', Model\Transfer\InterBankRequest::class);
        self::register('INTERRS', Model\Transfer\InterBankResponse::class);
        self::register('INTERMODRQ', Model\Transfer\InterBankModRequest::class);
        self::register('INTERMODRS', Model\Transfer\InterBankModResponse::class);
        self::register('INTERCANCRQ', Model\Transfer\InterBankCancelRequest::class);
        self::register('INTERCANCRS', Model\Transfer\InterBankCancelResponse::class);
        self::register('XFERINFO', Model\Transfer\TransferInfo::class);
        self::register('XFERPRCSTS', Model\Transfer\TransferProcessingStatus::class);

        // Transfer - Wire
        self::register('WIREXFERMSGSRQV1', Model\Transfer\WireTransferMessagesRequestV1::class);
        self::register('WIREXFERMSGSRSV1', Model\Transfer\WireTransferMessagesResponseV1::class);
        self::register('WIRETRNRQ', Model\Transfer\WireTransactionRequest::class);
        self::register('WIRETRNRS', Model\Transfer\WireTransactionResponse::class);
        self::register('WIRERQ', Model\Transfer\WireRequest::class);
        self::register('WIRERS', Model\Transfer\WireResponse::class);
        self::register('WIRECANCRQ', Model\Transfer\WireCancelRequest::class);
        self::register('WIRECANCRS', Model\Transfer\WireCancelResponse::class);
        self::register('WIREDESTBANK', Model\Transfer\WireDestBank::class);
        self::register('WIREBENEFICIARY', Model\Transfer\WireBeneficiary::class);

        // Tax 1099
        self::register('TAX1099MSGSRQV1', Model\Tax\Tax1099MessagesRequestV1::class);
        self::register('TAX1099MSGSRSV1', Model\Tax\Tax1099MessagesResponseV1::class);
        self::register('TAX1099TRNRQ', Model\Tax\Tax1099TransactionRequest::class);
        self::register('TAX1099TRNRS', Model\Tax\Tax1099TransactionResponse::class);
        self::register('TAX1099RQ', Model\Tax\Tax1099Request::class);
        self::register('TAX1099RS', Model\Tax\Tax1099Response::class);

        // Tax 1099 - Supporting
        self::register('PAYERADDR', Model\Tax\PayerAddress::class);
        self::register('RECADDR', Model\Tax\RecipientAddress::class);
        self::register('RECID', Model\Tax\RecipientId::class);
        self::register('PAYERID', Model\Tax\PayerId::class);
        self::register('STATEINFO', Model\Tax\StateInfo::class);
        self::register('LOCALINFO', Model\Tax\LocalInfo::class);
        self::register('ADDLSTTAXWHAGG', Model\Tax\AddlStateTaxWhAgg::class);
        self::register('FOREIGNACCTCOMP', Model\Tax\ForeignAccountTaxComp::class);
        self::register('STKBND', Model\Tax\SecuritySalesInfo::class);
        self::register('EXTDBINFO_V100', Model\Tax\ExtendedBInfo::class);
        self::register('PROCDET_V100', Model\Tax\ProcDet::class);
        self::register('FATCAFILING', Model\Tax\FatcaFilingRequirement::class);
        self::register('SECURITYSUM', Model\Tax\Tax1099BSecuritiesSummary::class);

        // Tax 1099 - Forms
        self::register('TAX1099INT_V100', Model\Tax\Tax1099Int::class);
        self::register('TAX1099DIV_V100', Model\Tax\Tax1099Div::class);
        self::register('TAX1099B_V100', Model\Tax\Tax1099B::class);
        self::register('TAX1099R_V100', Model\Tax\Tax1099R::class);
        self::register('TAX1099MISC_V100', Model\Tax\Tax1099Misc::class);
        self::register('TAX1099OID_V100', Model\Tax\Tax1099Oid::class);
        self::register('TAX1099G_V100', Model\Tax\Tax1099G::class);
        self::register('TAX1099C_V100', Model\Tax\Tax1099C::class);
        self::register('TAX1099CAP_V100', Model\Tax\Tax1099Cap::class);
        self::register('TAX1099LTC_V100', Model\Tax\Tax1099Ltc::class);
        self::register('TAX1099Q_V100', Model\Tax\Tax1099Q::class);
        self::register('TAX1099SA_V100', Model\Tax\Tax1099Sa::class);
        self::register('TAX1099S_V100', Model\Tax\Tax1099S::class);
        self::register('TAX1099H_V100', Model\Tax\Tax1099H::class);
        self::register('TAX1099PATR_V100', Model\Tax\Tax1099Patr::class);
    }
}
