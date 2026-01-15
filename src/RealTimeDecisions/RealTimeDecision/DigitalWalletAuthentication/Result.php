<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication;

/**
 * Whether your application successfully delivered the one-time passcode.
 */
enum Result: string
{
    case SUCCESS = 'success';

    case FAILURE = 'failure';
}
