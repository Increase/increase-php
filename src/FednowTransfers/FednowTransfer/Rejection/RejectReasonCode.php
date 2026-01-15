<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer\Rejection;

/**
 * The reason the transfer was rejected as provided by the recipient bank or the FedNow network.
 */
enum RejectReasonCode: string
{
    case ACCOUNT_CLOSED = 'account_closed';

    case ACCOUNT_BLOCKED = 'account_blocked';

    case INVALID_CREDITOR_ACCOUNT_TYPE = 'invalid_creditor_account_type';

    case INVALID_CREDITOR_ACCOUNT_NUMBER = 'invalid_creditor_account_number';

    case INVALID_CREDITOR_FINANCIAL_INSTITUTION_IDENTIFIER = 'invalid_creditor_financial_institution_identifier';

    case END_CUSTOMER_DECEASED = 'end_customer_deceased';

    case NARRATIVE = 'narrative';

    case TRANSACTION_FORBIDDEN = 'transaction_forbidden';

    case TRANSACTION_TYPE_NOT_SUPPORTED = 'transaction_type_not_supported';

    case AMOUNT_EXCEEDS_BANK_LIMITS = 'amount_exceeds_bank_limits';

    case INVALID_CREDITOR_ADDRESS = 'invalid_creditor_address';

    case INVALID_DEBTOR_ADDRESS = 'invalid_debtor_address';

    case TIMEOUT = 'timeout';

    case PROCESSING_ERROR = 'processing_error';

    case OTHER = 'other';
}
