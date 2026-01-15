<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization;

/**
 * Whether or not the authorization was approved.
 */
enum Decision: string
{
    case APPROVE = 'approve';

    case DECLINE = 'decline';
}
