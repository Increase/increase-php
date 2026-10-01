<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;

/**
 * A constant representing the object's type. For this resource it will always be `digital_wallet_token_request`.
 */
enum Type: string
{
    case DIGITAL_WALLET_TOKEN_REQUEST = 'digital_wallet_token_request';
}
