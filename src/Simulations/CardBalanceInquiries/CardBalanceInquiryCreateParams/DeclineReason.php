<?php

declare(strict_types=1);

namespace Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams;

/**
 * Forces a card decline with a specific reason. No real time decision will be sent.
 */
enum DeclineReason: string
{
    case ACCOUNT_CLOSED = 'account_closed';

    case CARD_NOT_ACTIVE = 'card_not_active';

    case CARD_CANCELED = 'card_canceled';

    case PHYSICAL_CARD_NOT_ACTIVE = 'physical_card_not_active';

    case ENTITY_NOT_ACTIVE = 'entity_not_active';

    case GROUP_LOCKED = 'group_locked';

    case INSUFFICIENT_FUNDS = 'insufficient_funds';

    case CVV2_MISMATCH = 'cvv2_mismatch';

    case PIN_MISMATCH = 'pin_mismatch';

    case CARD_EXPIRATION_MISMATCH = 'card_expiration_mismatch';

    case TRANSACTION_NOT_ALLOWED = 'transaction_not_allowed';

    case BREACHES_LIMIT = 'breaches_limit';

    case WEBHOOK_DECLINED = 'webhook_declined';

    case WEBHOOK_TIMED_OUT = 'webhook_timed_out';

    case DECLINED_BY_STAND_IN_PROCESSING = 'declined_by_stand_in_processing';

    case INVALID_PHYSICAL_CARD = 'invalid_physical_card';

    case MISSING_ORIGINAL_AUTHORIZATION = 'missing_original_authorization';

    case FAILED_3DS_AUTHENTICATION = 'failed_3ds_authentication';

    case SUSPECTED_CARD_TESTING = 'suspected_card_testing';

    case SUSPECTED_FRAUD = 'suspected_fraud';
}
