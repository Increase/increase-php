<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification\NotificationsOfChange;

/**
 * The required type of change that is being signaled by the receiving financial institution.
 */
enum ChangeCode: string
{
    case INCORRECT_ACCOUNT_NUMBER = 'incorrect_account_number';

    case INCORRECT_ROUTING_NUMBER = 'incorrect_routing_number';

    case INCORRECT_ROUTING_NUMBER_AND_ACCOUNT_NUMBER = 'incorrect_routing_number_and_account_number';

    case INCORRECT_TRANSACTION_CODE = 'incorrect_transaction_code';

    case INCORRECT_ACCOUNT_NUMBER_AND_TRANSACTION_CODE = 'incorrect_account_number_and_transaction_code';

    case INCORRECT_ROUTING_NUMBER_ACCOUNT_NUMBER_AND_TRANSACTION_CODE = 'incorrect_routing_number_account_number_and_transaction_code';

    case INCORRECT_RECEIVING_DEPOSITORY_FINANCIAL_INSTITUTION_IDENTIFICATION = 'incorrect_receiving_depository_financial_institution_identification';

    case INCORRECT_INDIVIDUAL_IDENTIFICATION_NUMBER = 'incorrect_individual_identification_number';

    case ADDENDA_FORMAT_ERROR = 'addenda_format_error';

    case INCORRECT_STANDARD_ENTRY_CLASS_CODE_FOR_OUTBOUND_INTERNATIONAL_PAYMENT = 'incorrect_standard_entry_class_code_for_outbound_international_payment';

    case MISROUTED_NOTIFICATION_OF_CHANGE = 'misrouted_notification_of_change';

    case INCORRECT_TRACE_NUMBER = 'incorrect_trace_number';

    case INCORRECT_COMPANY_IDENTIFICATION_NUMBER = 'incorrect_company_identification_number';

    case INCORRECT_IDENTIFICATION_NUMBER = 'incorrect_identification_number';

    case INCORRECTLY_FORMATTED_CORRECTED_DATA = 'incorrectly_formatted_corrected_data';

    case INCORRECT_DISCRETIONARY_DATA = 'incorrect_discretionary_data';

    case ROUTING_NUMBER_NOT_FROM_ORIGINAL_ENTRY_DETAIL_RECORD = 'routing_number_not_from_original_entry_detail_record';

    case DEPOSITORY_FINANCIAL_INSTITUTION_ACCOUNT_NUMBER_NOT_FROM_ORIGINAL_ENTRY_DETAIL_RECORD = 'depository_financial_institution_account_number_not_from_original_entry_detail_record';

    case INCORRECT_TRANSACTION_CODE_BY_ORIGINATING_DEPOSITORY_FINANCIAL_INSTITUTION = 'incorrect_transaction_code_by_originating_depository_financial_institution';
}
