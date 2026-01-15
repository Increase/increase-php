<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\Fraud;

/**
 * Fraud type.
 */
enum FraudType: string
{
    case ACCOUNT_OR_CREDENTIALS_TAKEOVER = 'account_or_credentials_takeover';

    case CARD_NOT_RECEIVED_AS_ISSUED = 'card_not_received_as_issued';

    case FRAUDULENT_APPLICATION = 'fraudulent_application';

    case FRAUDULENT_USE_OF_ACCOUNT_NUMBER = 'fraudulent_use_of_account_number';

    case INCORRECT_PROCESSING = 'incorrect_processing';

    case ISSUER_REPORTED_COUNTERFEIT = 'issuer_reported_counterfeit';

    case LOST = 'lost';

    case MANIPULATION_OF_ACCOUNT_HOLDER = 'manipulation_of_account_holder';

    case MERCHANT_MISREPRESENTATION = 'merchant_misrepresentation';

    case MISCELLANEOUS = 'miscellaneous';

    case STOLEN = 'stolen';
}
