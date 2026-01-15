<?php

declare(strict_types=1);

namespace Increase\CardTokens\CardTokenCapabilities;

/**
 * A constant representing the object's type. For this resource it will always be `card_token_capabilities`.
 */
enum Type: string
{
    case CARD_TOKEN_CAPABILITIES = 'card_token_capabilities';
}
