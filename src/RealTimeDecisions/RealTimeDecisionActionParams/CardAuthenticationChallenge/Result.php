<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge;

/**
 * Whether the card authentication challenge was successfully delivered to the cardholder.
 */
enum Result: string
{
    case SUCCESS = 'success';

    case FAILURE = 'failure';
}
