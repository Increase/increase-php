<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken;

/**
 * How the card number was provided to the digital wallet.
 */
enum PrimaryAccountNumberSource: string
{
    case KEY_ENTERED = 'key_entered';

    case ON_FILE = 'on_file';

    case MOBILE_APP = 'mobile_app';

    case TOKEN = 'token';

    case CHIP_DIP = 'chip_dip';

    case CONTACTLESS_TAP = 'contactless_tap';
}
