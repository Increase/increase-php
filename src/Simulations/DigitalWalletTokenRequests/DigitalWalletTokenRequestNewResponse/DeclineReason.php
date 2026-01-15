<?php

declare(strict_types=1);

namespace Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestNewResponse;

/**
 * If the simulated tokenization attempt was declined, this field contains details as to why.
 */
enum DeclineReason: string
{
    case CARD_NOT_ACTIVE = 'card_not_active';

    case NO_VERIFICATION_METHOD = 'no_verification_method';

    case WEBHOOK_TIMED_OUT = 'webhook_timed_out';

    case WEBHOOK_DECLINED = 'webhook_declined';
}
