<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication;

/**
 * Whether or not the authentication attempt was approved.
 */
enum Decision: string
{
    case APPROVE = 'approve';

    case CHALLENGE = 'challenge';

    case DENY = 'deny';
}
