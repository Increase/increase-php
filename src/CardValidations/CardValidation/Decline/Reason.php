<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation\Decline;

/**
 * The reason why the validation was declined.
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

    case TRANSACTION_NOT_SUPPORTED_OR_BLOCKED_BY_ISSUER = 'transaction_not_supported_or_blocked_by_issuer';

    case SUSPECTED_FRAUD = 'suspected_fraud';

    case ACTIVITY_AMOUNT_LIMIT_EXCEEDED = 'activity_amount_limit_exceeded';

    case RESTRICTED_CARD = 'restricted_card';

    case SECURITY_VIOLATION = 'security_violation';

    case TRANSACTION_DOES_NOT_FULFILL_ANTI_MONEY_LAUNDERING_REQUIREMENT = 'transaction_does_not_fulfill_anti_money_laundering_requirement';

    case BLOCKED_BY_CARDHOLDER = 'blocked_by_cardholder';

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

    case UNABLE_TO_LOCATE_RECORD = 'unable_to_locate_record';

    case FILE_IS_TEMPORARILY_UNAVAILABLE = 'file_is_temporarily_unavailable';

    case INCORRECT_PIN = 'incorrect_pin';

    case ALLOWABLE_NUMBER_OF_PIN_ENTRY_TRIES_EXCEEDED = 'allowable_number_of_pin_entry_tries_exceeded';

    case UNABLE_TO_LOCATE_PREVIOUS_MESSAGE = 'unable_to_locate_previous_message';

    case DATA_INCONSISTENT_WITH_ORIGINAL_MESSAGE = 'data_inconsistent_with_original_message';

    case PIN_ERROR_FOUND = 'pin_error_found';

    case CANNOT_VERIFY_PIN = 'cannot_verify_pin';

    case VERIFICATION_DATA_FAILED = 'verification_data_failed';

    case SURCHARGE_AMOUNT_NOT_SUPPORTED_BY_DEBIT_NETWORK_ISSUER = 'surcharge_amount_not_supported_by_debit_network_issuer';

    case CASH_SERVICE_NOT_AVAILABLE = 'cash_service_not_available';

    case CASHBACK_REQUEST_EXCEEDS_ISSUER_LIMIT = 'cashback_request_exceeds_issuer_limit';

    case TRANSACTION_AMOUNT_EXCEEDS_PRE_AUTHORIZED_APPROVAL_AMOUNT = 'transaction_amount_exceeds_pre_authorized_approval_amount';

    case INVALID_BILLER_INFORMATION = 'invalid_biller_information';

    case PIN_CHANGE_REQUEST_DECLINED = 'pin_change_request_declined';

    case UNSAFE_PIN = 'unsafe_pin';

    case TRANSACTION_DOES_NOT_QUALIFY_FOR_VISA_PIN = 'transaction_does_not_qualify_for_visa_pin';

    case OFFLINE_DECLINED = 'offline_declined';

    case UNABLE_TO_GO_ONLINE = 'unable_to_go_online';

    case VALID_ACCOUNT_BUT_AMOUNT_NOT_SUPPORTED = 'valid_account_but_amount_not_supported';

    case INVALID_USE_OF_MERCHANT_CATEGORY_CODE_CORRECT_AND_REATTEMPT = 'invalid_use_of_merchant_category_code_correct_and_reattempt';

    case FORWARD_TO_ISSUER = 'forward_to_issuer';

    case CARD_AUTHENTICATION_FAILED = 'card_authentication_failed';
}
