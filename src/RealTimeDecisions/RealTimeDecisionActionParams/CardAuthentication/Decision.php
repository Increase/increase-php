<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication;

/**
 * Whether the card authentication attempt should be approved or declined.
 */
enum Decision: string
{
    case APPROVE = 'approve';

    case CHALLENGE = 'challenge';

    case DENY = 'deny';
}
