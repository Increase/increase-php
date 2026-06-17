<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken\Decline;

/**
 * The reason the token provisioning was declined.
 */
enum Reason: string
{
    case CARD_NOT_ACTIVE = 'card_not_active';

    case NO_VERIFICATION_METHOD = 'no_verification_method';

    case WEBHOOK_TIMED_OUT = 'webhook_timed_out';

    case WEBHOOK_DECLINED = 'webhook_declined';

    case INCORRECT_CARD_VERIFICATION_CODE = 'incorrect_card_verification_code';

    case DECLINED_BY_TOKEN_REQUESTOR = 'declined_by_token_requestor';
}
