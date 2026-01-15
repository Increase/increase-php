<?php

declare(strict_types=1);

namespace Increase\Simulations\ACHTransfers\ACHTransferReturnParams;

/**
 * The reason why the Federal Reserve or destination bank returned this transfer. Defaults to `no_account`.
 */
enum Reason: string
{
    case INSUFFICIENT_FUND = 'insufficient_fund';

    case NO_ACCOUNT = 'no_account';

    case ACCOUNT_CLOSED = 'account_closed';

    case INVALID_ACCOUNT_NUMBER_STRUCTURE = 'invalid_account_number_structure';

    case ACCOUNT_FROZEN_ENTRY_RETURNED_PER_OFAC_INSTRUCTION = 'account_frozen_entry_returned_per_ofac_instruction';

    case CREDIT_ENTRY_REFUSED_BY_RECEIVER = 'credit_entry_refused_by_receiver';

    case UNAUTHORIZED_DEBIT_TO_CONSUMER_ACCOUNT_USING_CORPORATE_SEC_CODE = 'unauthorized_debit_to_consumer_account_using_corporate_sec_code';

    case CORPORATE_CUSTOMER_ADVISED_NOT_AUTHORIZED = 'corporate_customer_advised_not_authorized';

    case PAYMENT_STOPPED = 'payment_stopped';

    case NON_TRANSACTION_ACCOUNT = 'non_transaction_account';

    case UNCOLLECTED_FUNDS = 'uncollected_funds';

    case ROUTING_NUMBER_CHECK_DIGIT_ERROR = 'routing_number_check_digit_error';

    case CUSTOMER_ADVISED_UNAUTHORIZED_IMPROPER_INELIGIBLE_OR_INCOMPLETE = 'customer_advised_unauthorized_improper_ineligible_or_incomplete';

    case AMOUNT_FIELD_ERROR = 'amount_field_error';

    case AUTHORIZATION_REVOKED_BY_CUSTOMER = 'authorization_revoked_by_customer';

    case INVALID_ACH_ROUTING_NUMBER = 'invalid_ach_routing_number';

    case FILE_RECORD_EDIT_CRITERIA = 'file_record_edit_criteria';

    case ENR_INVALID_INDIVIDUAL_NAME = 'enr_invalid_individual_name';

    case RETURNED_PER_ODFI_REQUEST = 'returned_per_odfi_request';

    case LIMITED_PARTICIPATION_DFI = 'limited_participation_dfi';

    case INCORRECTLY_CODED_OUTBOUND_INTERNATIONAL_PAYMENT = 'incorrectly_coded_outbound_international_payment';

    case ACCOUNT_SOLD_TO_ANOTHER_DFI = 'account_sold_to_another_dfi';

    case ADDENDA_ERROR = 'addenda_error';

    case BENEFICIARY_OR_ACCOUNT_HOLDER_DECEASED = 'beneficiary_or_account_holder_deceased';

    case CUSTOMER_ADVISED_NOT_WITHIN_AUTHORIZATION_TERMS = 'customer_advised_not_within_authorization_terms';

    case CORRECTED_RETURN = 'corrected_return';

    case DUPLICATE_ENTRY = 'duplicate_entry';

    case DUPLICATE_RETURN = 'duplicate_return';

    case ENR_DUPLICATE_ENROLLMENT = 'enr_duplicate_enrollment';

    case ENR_INVALID_DFI_ACCOUNT_NUMBER = 'enr_invalid_dfi_account_number';

    case ENR_INVALID_INDIVIDUAL_ID_NUMBER = 'enr_invalid_individual_id_number';

    case ENR_INVALID_REPRESENTATIVE_PAYEE_INDICATOR = 'enr_invalid_representative_payee_indicator';

    case ENR_INVALID_TRANSACTION_CODE = 'enr_invalid_transaction_code';

    case ENR_RETURN_OF_ENR_ENTRY = 'enr_return_of_enr_entry';

    case ENR_ROUTING_NUMBER_CHECK_DIGIT_ERROR = 'enr_routing_number_check_digit_error';

    case ENTRY_NOT_PROCESSED_BY_GATEWAY = 'entry_not_processed_by_gateway';

    case FIELD_ERROR = 'field_error';

    case FOREIGN_RECEIVING_DFI_UNABLE_TO_SETTLE = 'foreign_receiving_dfi_unable_to_settle';

    case IAT_ENTRY_CODING_ERROR = 'iat_entry_coding_error';

    case IMPROPER_EFFECTIVE_ENTRY_DATE = 'improper_effective_entry_date';

    case IMPROPER_SOURCE_DOCUMENT_SOURCE_DOCUMENT_PRESENTED = 'improper_source_document_source_document_presented';

    case INVALID_COMPANY_ID = 'invalid_company_id';

    case INVALID_FOREIGN_RECEIVING_DFI_IDENTIFICATION = 'invalid_foreign_receiving_dfi_identification';

    case INVALID_INDIVIDUAL_ID_NUMBER = 'invalid_individual_id_number';

    case ITEM_AND_RCK_ENTRY_PRESENTED_FOR_PAYMENT = 'item_and_rck_entry_presented_for_payment';

    case ITEM_RELATED_TO_RCK_ENTRY_IS_INELIGIBLE = 'item_related_to_rck_entry_is_ineligible';

    case MANDATORY_FIELD_ERROR = 'mandatory_field_error';

    case MISROUTED_DISHONORED_RETURN = 'misrouted_dishonored_return';

    case MISROUTED_RETURN = 'misrouted_return';

    case NO_ERRORS_FOUND = 'no_errors_found';

    case NON_ACCEPTANCE_OF_R62_DISHONORED_RETURN = 'non_acceptance_of_r62_dishonored_return';

    case NON_PARTICIPANT_IN_IAT_PROGRAM = 'non_participant_in_iat_program';

    case PERMISSIBLE_RETURN_ENTRY = 'permissible_return_entry';

    case PERMISSIBLE_RETURN_ENTRY_NOT_ACCEPTED = 'permissible_return_entry_not_accepted';

    case RDFI_NON_SETTLEMENT = 'rdfi_non_settlement';

    case RDFI_PARTICIPANT_IN_CHECK_TRUNCATION_PROGRAM = 'rdfi_participant_in_check_truncation_program';

    case REPRESENTATIVE_PAYEE_DECEASED_OR_UNABLE_TO_CONTINUE_IN_THAT_CAPACITY = 'representative_payee_deceased_or_unable_to_continue_in_that_capacity';

    case RETURN_NOT_A_DUPLICATE = 'return_not_a_duplicate';

    case RETURN_OF_ERRONEOUS_OR_REVERSING_DEBIT = 'return_of_erroneous_or_reversing_debit';

    case RETURN_OF_IMPROPER_CREDIT_ENTRY = 'return_of_improper_credit_entry';

    case RETURN_OF_IMPROPER_DEBIT_ENTRY = 'return_of_improper_debit_entry';

    case RETURN_OF_XCK_ENTRY = 'return_of_xck_entry';

    case SOURCE_DOCUMENT_PRESENTED_FOR_PAYMENT = 'source_document_presented_for_payment';

    case STATE_LAW_AFFECTING_RCK_ACCEPTANCE = 'state_law_affecting_rck_acceptance';

    case STOP_PAYMENT_ON_ITEM_RELATED_TO_RCK_ENTRY = 'stop_payment_on_item_related_to_rck_entry';

    case STOP_PAYMENT_ON_SOURCE_DOCUMENT = 'stop_payment_on_source_document';

    case TIMELY_ORIGINAL_RETURN = 'timely_original_return';

    case TRACE_NUMBER_ERROR = 'trace_number_error';

    case UNTIMELY_DISHONORED_RETURN = 'untimely_dishonored_return';

    case UNTIMELY_RETURN = 'untimely_return';
}
