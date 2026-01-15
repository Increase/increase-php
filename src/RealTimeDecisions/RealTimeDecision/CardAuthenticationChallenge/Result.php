<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthenticationChallenge;

/**
 * Whether or not the challenge was delivered to the cardholder.
 */
enum Result: string
{
    case SUCCESS = 'success';

    case FAILURE = 'failure';
}
