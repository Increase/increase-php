<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\SchemeFee;

/**
 * The type of fee being assessed.
 */
enum FeeType: string
{
    case VISA_INTERNATIONAL_SERVICE_ASSESSMENT_SINGLE_CURRENCY = 'visa_international_service_assessment_single_currency';

    case VISA_INTERNATIONAL_SERVICE_ASSESSMENT_CROSS_CURRENCY = 'visa_international_service_assessment_cross_currency';

    case VISA_AUTHORIZATION_DOMESTIC_POINT_OF_SALE = 'visa_authorization_domestic_point_of_sale';

    case VISA_AUTHORIZATION_INTERNATIONAL_POINT_OF_SALE = 'visa_authorization_international_point_of_sale';

    case VISA_AUTHORIZATION_CANADA_POINT_OF_SALE = 'visa_authorization_canada_point_of_sale';

    case VISA_AUTHORIZATION_REVERSAL_POINT_OF_SALE = 'visa_authorization_reversal_point_of_sale';

    case VISA_AUTHORIZATION_REVERSAL_INTERNATIONAL_POINT_OF_SALE = 'visa_authorization_reversal_international_point_of_sale';

    case VISA_AUTHORIZATION_ADDRESS_VERIFICATION_SERVICE = 'visa_authorization_address_verification_service';

    case VISA_ADVANCED_AUTHORIZATION = 'visa_advanced_authorization';

    case VISA_MESSAGE_TRANSMISSION = 'visa_message_transmission';

    case VISA_ACCOUNT_VERIFICATION_DOMESTIC = 'visa_account_verification_domestic';

    case VISA_ACCOUNT_VERIFICATION_INTERNATIONAL = 'visa_account_verification_international';

    case VISA_ACCOUNT_VERIFICATION_CANADA = 'visa_account_verification_canada';

    case VISA_CORPORATE_ACCEPTANCE_FEE = 'visa_corporate_acceptance_fee';

    case VISA_CONSUMER_DEBIT_ACCEPTANCE_FEE = 'visa_consumer_debit_acceptance_fee';

    case VISA_BUSINESS_DEBIT_ACCEPTANCE_FEE = 'visa_business_debit_acceptance_fee';

    case VISA_PURCHASING_ACCEPTANCE_FEE = 'visa_purchasing_acceptance_fee';

    case VISA_PURCHASE_DOMESTIC = 'visa_purchase_domestic';

    case VISA_PURCHASE_INTERNATIONAL = 'visa_purchase_international';

    case VISA_CREDIT_PURCHASE_TOKEN = 'visa_credit_purchase_token';

    case VISA_DEBIT_PURCHASE_TOKEN = 'visa_debit_purchase_token';

    case VISA_CLEARING_TRANSMISSION = 'visa_clearing_transmission';

    case VISA_DIRECT_AUTHORIZATION = 'visa_direct_authorization';

    case VISA_DIRECT_TRANSACTION_DOMESTIC = 'visa_direct_transaction_domestic';

    case VISA_SERVICE_COMMERCIAL_CREDIT = 'visa_service_commercial_credit';

    case VISA_ADVERTISING_SERVICE_COMMERCIAL_CREDIT = 'visa_advertising_service_commercial_credit';

    case VISA_COMMUNITY_GROWTH_ACCELERATION_PROGRAM = 'visa_community_growth_acceleration_program';

    case VISA_PROCESSING_GUARANTEE_COMMERCIAL_CREDIT = 'visa_processing_guarantee_commercial_credit';

    case PULSE_SWITCH_FEE = 'pulse_switch_fee';
}
