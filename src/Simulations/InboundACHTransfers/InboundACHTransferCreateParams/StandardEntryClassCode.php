<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams;

/**
 * The standard entry class code for the transfer.
 */
enum StandardEntryClassCode: string
{
    case CORPORATE_CREDIT_OR_DEBIT = 'corporate_credit_or_debit';

    case CORPORATE_TRADE_EXCHANGE = 'corporate_trade_exchange';

    case PREARRANGED_PAYMENTS_AND_DEPOSIT = 'prearranged_payments_and_deposit';

    case INTERNET_INITIATED = 'internet_initiated';

    case POINT_OF_SALE = 'point_of_sale';

    case TELEPHONE_INITIATED = 'telephone_initiated';

    case CUSTOMER_INITIATED = 'customer_initiated';

    case ACCOUNTS_RECEIVABLE = 'accounts_receivable';

    case MACHINE_TRANSFER = 'machine_transfer';

    case SHARED_NETWORK_TRANSACTION = 'shared_network_transaction';

    case REPRESENTED_CHECK = 'represented_check';

    case BACK_OFFICE_CONVERSION = 'back_office_conversion';

    case POINT_OF_PURCHASE = 'point_of_purchase';

    case CHECK_TRUNCATION = 'check_truncation';

    case DESTROYED_CHECK = 'destroyed_check';

    case INTERNATIONAL_ACH_TRANSACTION = 'international_ach_transaction';
}
