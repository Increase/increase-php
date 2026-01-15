<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication;

/**
 * The digital wallet app being used.
 */
enum DigitalWallet: string
{
    case APPLE_PAY = 'apple_pay';

    case GOOGLE_PAY = 'google_pay';

    case SAMSUNG_PAY = 'samsung_pay';

    case UNKNOWN = 'unknown';
}
