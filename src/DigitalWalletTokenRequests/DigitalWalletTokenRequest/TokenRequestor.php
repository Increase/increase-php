<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;

/**
 * The digital wallet app being used.
 */
enum TokenRequestor: string
{
    case APPLE_PAY = 'apple_pay';

    case GOOGLE_PAY = 'google_pay';

    case SAMSUNG_PAY = 'samsung_pay';

    case GARMIN_PAY = 'garmin_pay';

    case UNKNOWN = 'unknown';
}
