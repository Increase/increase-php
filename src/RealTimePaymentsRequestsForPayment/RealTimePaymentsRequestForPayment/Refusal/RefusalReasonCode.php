<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Refusal;

/**
 * The reason the request for payment was refused as provided by the recipient bank or the customer.
 */
enum RefusalReasonCode: string
{
    case ACCOUNT_BLOCKED = 'account_blocked';

    case TRANSACTION_FORBIDDEN = 'transaction_forbidden';

    case TRANSACTION_TYPE_NOT_SUPPORTED = 'transaction_type_not_supported';

    case UNEXPECTED_AMOUNT = 'unexpected_amount';

    case AMOUNT_EXCEEDS_BANK_LIMITS = 'amount_exceeds_bank_limits';

    case INVALID_DEBTOR_ADDRESS = 'invalid_debtor_address';

    case INVALID_CREDITOR_ADDRESS = 'invalid_creditor_address';

    case CREDITOR_IDENTIFIER_INCORRECT = 'creditor_identifier_incorrect';

    case REQUESTED_BY_CUSTOMER = 'requested_by_customer';

    case ORDER_REJECTED = 'order_rejected';

    case END_CUSTOMER_DECEASED = 'end_customer_deceased';

    case CUSTOMER_HAS_OPTED_OUT = 'customer_has_opted_out';

    case OTHER = 'other';
}
