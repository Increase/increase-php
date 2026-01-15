<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda;

/**
 * The type of transfer. Set by the originator.
 */
enum InternationalTransactionTypeCode: string
{
    case ANNUITY = 'annuity';

    case BUSINESS_OR_COMMERCIAL = 'business_or_commercial';

    case DEPOSIT = 'deposit';

    case LOAN = 'loan';

    case MISCELLANEOUS = 'miscellaneous';

    case MORTGAGE = 'mortgage';

    case PENSION = 'pension';

    case REMITTANCE = 'remittance';

    case RENT_OR_LEASE = 'rent_or_lease';

    case SALARY_OR_PAYROLL = 'salary_or_payroll';

    case TAX = 'tax';

    case ACCOUNTS_RECEIVABLE = 'accounts_receivable';

    case BACK_OFFICE_CONVERSION = 'back_office_conversion';

    case MACHINE_TRANSFER = 'machine_transfer';

    case POINT_OF_PURCHASE = 'point_of_purchase';

    case POINT_OF_SALE = 'point_of_sale';

    case REPRESENTED_CHECK = 'represented_check';

    case SHARED_NETWORK_TRANSACTION = 'shared_network_transaction';

    case TELPHONE_INITIATED = 'telphone_initiated';

    case INTERNET_INITIATED = 'internet_initiated';
}
