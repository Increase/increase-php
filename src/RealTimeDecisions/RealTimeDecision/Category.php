<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

/**
 * The category of the Real-Time Decision.
 */
enum Category: string
{
    case CARD_AUTHORIZATION_REQUESTED = 'card_authorization_requested';

    case CARD_BALANCE_INQUIRY_REQUESTED = 'card_balance_inquiry_requested';

    case CARD_AUTHENTICATION_REQUESTED = 'card_authentication_requested';

    case CARD_AUTHENTICATION_CHALLENGE_REQUESTED = 'card_authentication_challenge_requested';

    case DIGITAL_WALLET_TOKEN_REQUESTED = 'digital_wallet_token_requested';

    case DIGITAL_WALLET_AUTHENTICATION_REQUESTED = 'digital_wallet_authentication_requested';
}
