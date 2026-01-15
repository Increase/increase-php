<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken;

/**
 * A constant representing the object's type. For this resource it will always be `digital_wallet_token`.
 */
enum Type: string
{
    case DIGITAL_WALLET_TOKEN = 'digital_wallet_token';
}
