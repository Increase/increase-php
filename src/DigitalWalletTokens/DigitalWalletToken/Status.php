<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken;

/**
 * This indicates if payments can be made with the Digital Wallet Token.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    case SUSPENDED = 'suspended';

    case DEACTIVATED = 'deactivated';
}
