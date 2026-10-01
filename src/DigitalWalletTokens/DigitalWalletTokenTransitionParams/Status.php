<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletTokenTransitionParams;

/**
 * The status to transition the Digital Wallet Token to.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case SUSPENDED = 'suspended';

    case DEACTIVATED = 'deactivated';
}
