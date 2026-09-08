<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer\Return_;

/**
 * The reason the transfer was returned as provided by the recipient's bank.
 */
enum ReturnReasonCode: string
{
    case ACCOUNT_CLOSED = 'account_closed';

    case ACCOUNT_BLOCKED = 'account_blocked';

    case INVALID_AGENT = 'invalid_agent';

    case INVALID_CREDITOR_ACCOUNT_NUMBER = 'invalid_creditor_account_number';

    case INCORRECT_ACCOUNT_NUMBER = 'incorrect_account_number';

    case END_CUSTOMER_DECEASED = 'end_customer_deceased';

    case TRANSACTION_FORBIDDEN = 'transaction_forbidden';

    case REGULATORY_REASON = 'regulatory_reason';

    case FRAUD = 'fraud';

    case DUPLICATION = 'duplication';

    case WRONG_AMOUNT = 'wrong_amount';

    case REQUESTED_BY_CUSTOMER = 'requested_by_customer';

    case UNABLE_TO_APPLY = 'unable_to_apply';

    case NOT_SPECIFIED = 'not_specified';

    case NARRATIVE = 'narrative';

    case OTHER = 'other';
}
