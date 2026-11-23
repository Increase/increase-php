<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken;

/**
 * The card network the token is being provisioned on.
 */
enum Network: string
{
    case VISA = 'visa';
}
