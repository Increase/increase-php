<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication;

/**
 * Whether your application was able to deliver the one-time passcode.
 */
enum Result: string
{
    case SUCCESS = 'success';

    case FAILURE = 'failure';
}
