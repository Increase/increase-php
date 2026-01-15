<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented\InvalidDispute;

/**
 * The reason a merchant considers the dispute invalid.
 */
enum Reason: string
{
    case AUTOMATIC_TELLER_MACHINE_TRANSACTION_PROOF_PROVIDED = 'automatic_teller_machine_transaction_proof_provided';

    case BALANCE_OF_PARTIAL_PREPAYMENT_NOT_PAID = 'balance_of_partial_prepayment_not_paid';

    case CARDHOLDER_CANCELED_BEFORE_EXPECTED_MERCHANDISE_RECEIPT_DATE = 'cardholder_canceled_before_expected_merchandise_receipt_date';

    case CARDHOLDER_CANCELED_BEFORE_EXPECTED_SERVICES_RECEIPT_DATE = 'cardholder_canceled_before_expected_services_receipt_date';

    case CARDHOLDER_CANCELED_DIFFERENT_DATE = 'cardholder_canceled_different_date';

    case CARDHOLDER_DID_NOT_CANCEL_ACCORDING_TO_POLICY = 'cardholder_did_not_cancel_according_to_policy';

    case CARDHOLDER_RECEIVED_MERCHANDISE = 'cardholder_received_merchandise';

    case COUNTRY_CODE_CORRECT = 'country_code_correct';

    case CREDIT_PROCESSED_CORRECTLY = 'credit_processed_correctly';

    case CURRENCY_CORRECT = 'currency_correct';

    case DISPUTE_IS_FOR_QUALITY = 'dispute_is_for_quality';

    case DISPUTE_IS_FOR_VISA_CASH_BACK_TRANSACTION_PORTION = 'dispute_is_for_visa_cash_back_transaction_portion';

    case DISPUTED_AMOUNT_IS_VALUE_ADDED_TAX = 'disputed_amount_is_value_added_tax';

    case DISPUTED_AMOUNT_IS_VALUE_ADDED_TAX_NO_CREDIT_RECEIPT_PROVIDED = 'disputed_amount_is_value_added_tax_no_credit_receipt_provided';

    case LIMITED_RETURN_OR_CANCELLATION_POLICY_PROPERLY_DISCLOSED = 'limited_return_or_cancellation_policy_properly_disclosed';

    case MERCHANDISE_HELD_AT_CARDHOLDER_CUSTOMS_AGENCY = 'merchandise_held_at_cardholder_customs_agency';

    case MERCHANDISE_MATCHES_DESCRIPTION = 'merchandise_matches_description';

    case MERCHANDISE_NOT_COUNTERFEIT = 'merchandise_not_counterfeit';

    case MERCHANDISE_NOT_DAMAGED = 'merchandise_not_damaged';

    case MERCHANDISE_NOT_DEFECTIVE = 'merchandise_not_defective';

    case MERCHANDISE_PROVIDED_PRIOR_TO_CANCELLATION_DATE = 'merchandise_provided_prior_to_cancellation_date';

    case MERCHANDISE_QUALITY_MATCHES_DESCRIPTION = 'merchandise_quality_matches_description';

    case MERCHANDISE_RETURN_NOT_ATTEMPTED = 'merchandise_return_not_attempted';

    case MERCHANT_NOT_NOTIFIED_OF_CLOSED_ACCOUNT = 'merchant_not_notified_of_closed_account';

    case NAME_ON_FLIGHT_MANIFEST_MATCHES_PURCHASE = 'name_on_flight_manifest_matches_purchase';

    case NO_CREDIT_RECEIPT_PROVIDED = 'no_credit_receipt_provided';

    case OTHER = 'other';

    case PROCESSING_ERROR_INCORRECT = 'processing_error_incorrect';

    case RETURNED_MECHANDISE_HELD_AT_CUSTOMS_AGENCY_OUTSIDE_MERCHANT_COUNTRY = 'returned_mechandise_held_at_customs_agency_outside_merchant_country';

    case SERVICES_MATCH_DESCRIPTION = 'services_match_description';

    case SERVICES_PROVIDED_PRIOR_TO_CANCELLATION_DATE = 'services_provided_prior_to_cancellation_date';

    case SERVICES_USED_AFTER_CANCELLATION_DATE = 'services_used_after_cancellation_date';

    case TERMS_OF_SERVICE_NOT_MISREPRESENTED = 'terms_of_service_not_misrepresented';

    case TRANSACTION_CODE_CORRECT = 'transaction_code_correct';
}
