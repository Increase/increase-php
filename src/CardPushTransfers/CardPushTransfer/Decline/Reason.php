<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransfer\Decline;

/**
 * The reason why the transfer was declined.
 */
enum Reason: string
{
    case DO_NOT_HONOR = 'do_not_honor';

    case ACTIVITY_COUNT_LIMIT_EXCEEDED = 'activity_count_limit_exceeded';

    case REFER_TO_CARD_ISSUER = 'refer_to_card_issuer';

    case REFER_TO_CARD_ISSUER_SPECIAL_CONDITION = 'refer_to_card_issuer_special_condition';

    case INVALID_MERCHANT = 'invalid_merchant';

    case PICK_UP_CARD = 'pick_up_card';

    case ERROR = 'error';

    case PICK_UP_CARD_SPECIAL = 'pick_up_card_special';

    case INVALID_TRANSACTION = 'invalid_transaction';

    case INVALID_AMOUNT = 'invalid_amount';

    case INVALID_ACCOUNT_NUMBER = 'invalid_account_number';

    case NO_SUCH_ISSUER = 'no_such_issuer';

    case RE_ENTER_TRANSACTION = 're_enter_transaction';

    case NO_CREDIT_ACCOUNT = 'no_credit_account';

    case PICK_UP_CARD_LOST = 'pick_up_card_lost';

    case PICK_UP_CARD_STOLEN = 'pick_up_card_stolen';

    case CLOSED_ACCOUNT = 'closed_account';

    case INSUFFICIENT_FUNDS = 'insufficient_funds';

    case NO_CHECKING_ACCOUNT = 'no_checking_account';

    case NO_SAVINGS_ACCOUNT = 'no_savings_account';

    case EXPIRED_CARD = 'expired_card';

    case TRANSACTION_NOT_PERMITTED_TO_CARDHOLDER = 'transaction_not_permitted_to_cardholder';

    case TRANSACTION_NOT_ALLOWED_AT_TERMINAL = 'transaction_not_allowed_at_terminal';

    case SUSPECTED_FRAUD = 'suspected_fraud';

    case ACTIVITY_AMOUNT_LIMIT_EXCEEDED = 'activity_amount_limit_exceeded';

    case RESTRICTED_CARD = 'restricted_card';

    case SECURITY_VIOLATION = 'security_violation';

    case TRANSACTION_DOES_NOT_FULFILL_ANTI_MONEY_LAUNDERING_REQUIREMENT = 'transaction_does_not_fulfill_anti_money_laundering_requirement';

    case BLOCKED_FIRST_USE = 'blocked_first_use';

    case CREDIT_ISSUER_UNAVAILABLE = 'credit_issuer_unavailable';

    case NEGATIVE_CARD_VERIFICATION_VALUE_RESULTS = 'negative_card_verification_value_results';

    case ISSUER_UNAVAILABLE = 'issuer_unavailable';

    case FINANCIAL_INSTITUTION_CANNOT_BE_FOUND = 'financial_institution_cannot_be_found';

    case TRANSACTION_CANNOT_BE_COMPLETED = 'transaction_cannot_be_completed';

    case DUPLICATE_TRANSACTION = 'duplicate_transaction';

    case SYSTEM_MALFUNCTION = 'system_malfunction';

    case ADDITIONAL_CUSTOMER_AUTHENTICATION_REQUIRED = 'additional_customer_authentication_required';

    case SURCHARGE_AMOUNT_NOT_PERMITTED = 'surcharge_amount_not_permitted';

    case DECLINE_FOR_CVV2_FAILURE = 'decline_for_cvv2_failure';

    case STOP_PAYMENT_ORDER = 'stop_payment_order';

    case REVOCATION_OF_AUTHORIZATION_ORDER = 'revocation_of_authorization_order';

    case REVOCATION_OF_ALL_AUTHORIZATIONS_ORDER = 'revocation_of_all_authorizations_order';
}
