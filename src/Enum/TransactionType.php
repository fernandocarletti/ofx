<?php

declare(strict_types=1);

namespace Ofx\Enum;

/**
 * Transaction types for bank and credit card statements.
 *
 * Used in STMTTRN aggregates to categorize transaction types.
 */
enum TransactionType: string
{
    /** Generic credit */
    case CREDIT = 'CREDIT';

    /** Generic debit */
    case DEBIT = 'DEBIT';

    /** Interest earned or paid */
    case INTEREST = 'INT';

    /** Dividend */
    case DIVIDEND = 'DIV';

    /** Financial institution fee */
    case FEE = 'FEE';

    /** Service charge */
    case SERVICE_CHARGE = 'SRVCHG';

    /** Deposit */
    case DEPOSIT = 'DEP';

    /** ATM debit or credit */
    case ATM = 'ATM';

    /** Point of sale debit or credit */
    case POS = 'POS';

    /** Transfer */
    case TRANSFER = 'XFER';

    /** Check */
    case CHECK = 'CHECK';

    /** Electronic payment */
    case PAYMENT = 'PAYMENT';

    /** Cash withdrawal */
    case CASH = 'CASH';

    /** Direct deposit */
    case DIRECT_DEPOSIT = 'DIRECTDEP';

    /** Merchant initiated debit */
    case DIRECT_DEBIT = 'DIRECTDEBIT';

    /** Repeating payment/standing order */
    case RECURRING_PAYMENT = 'REPEATPMT';

    /** Only valid in pending status */
    case HOLD = 'HOLD';

    /** Other transaction type */
    case OTHER = 'OTHER';
}
