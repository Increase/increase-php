<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification;

/**
 * The Standard Entry Class (SEC) code to use for the ACH Prenotification.
 */
enum StandardEntryClassCode: string
{
    case CORPORATE_CREDIT_OR_DEBIT = 'corporate_credit_or_debit';

    case CORPORATE_TRADE_EXCHANGE = 'corporate_trade_exchange';

    case PREARRANGED_PAYMENTS_AND_DEPOSIT = 'prearranged_payments_and_deposit';

    case INTERNET_INITIATED = 'internet_initiated';
}
