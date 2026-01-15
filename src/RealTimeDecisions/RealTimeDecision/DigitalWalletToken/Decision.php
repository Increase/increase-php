<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken;

/**
 * Whether or not the provisioning request was approved. This will be null until the real time decision is responded to.
 */
enum Decision: string
{
    case APPROVE = 'approve';

    case DECLINE = 'decline';
}
