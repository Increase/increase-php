<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication;

/**
 * The channel to send the card user their one-time passcode.
 */
enum Channel: string
{
    case SMS = 'sms';

    case EMAIL = 'email';
}
