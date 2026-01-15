<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken\Update;

/**
 * The status the update changed this Digital Wallet Token to.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    case SUSPENDED = 'suspended';

    case DEACTIVATED = 'deactivated';
}
