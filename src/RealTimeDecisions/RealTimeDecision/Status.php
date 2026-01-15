<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

/**
 * The status of the Real-Time Decision.
 */
enum Status: string
{
    case PENDING = 'pending';

    case RESPONDED = 'responded';

    case TIMED_OUT = 'timed_out';
}
