<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken\Device;

/**
 * Device type.
 */
enum DeviceType: string
{
    case UNKNOWN = 'unknown';

    case MOBILE_PHONE = 'mobile_phone';

    case TABLET = 'tablet';

    case WATCH = 'watch';

    case MOBILEPHONE_OR_TABLET = 'mobilephone_or_tablet';

    case PC = 'pc';

    case HOUSEHOLD_DEVICE = 'household_device';

    case WEARABLE_DEVICE = 'wearable_device';

    case AUTOMOBILE_DEVICE = 'automobile_device';
}
