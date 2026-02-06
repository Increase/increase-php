<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams;

/**
 * The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the transfer.
 */
enum StandardEntryClassCode: string
{
    case CORPORATE_CREDIT_OR_DEBIT = 'corporate_credit_or_debit';

    case CORPORATE_TRADE_EXCHANGE = 'corporate_trade_exchange';

    case PREARRANGED_PAYMENTS_AND_DEPOSIT = 'prearranged_payments_and_deposit';

    case INTERNET_INITIATED = 'internet_initiated';
}
