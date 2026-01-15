<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardFinancial\NetworkDetails\Visa;

/**
 * Only present when `actioner: network`. Describes why a card authorization was approved or declined by Visa through stand-in processing.
 */
enum StandInProcessingReason: string
{
    case ISSUER_ERROR = 'issuer_error';

    case INVALID_PHYSICAL_CARD = 'invalid_physical_card';

    case INVALID_CARDHOLDER_AUTHENTICATION_VERIFICATION_VALUE = 'invalid_cardholder_authentication_verification_value';

    case INTERNAL_VISA_ERROR = 'internal_visa_error';

    case MERCHANT_TRANSACTION_ADVISORY_SERVICE_AUTHENTICATION_REQUIRED = 'merchant_transaction_advisory_service_authentication_required';

    case PAYMENT_FRAUD_DISRUPTION_ACQUIRER_BLOCK = 'payment_fraud_disruption_acquirer_block';

    case OTHER = 'other';
}
