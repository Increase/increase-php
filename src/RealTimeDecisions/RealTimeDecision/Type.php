<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

/**
 * A constant representing the object's type. For this resource it will always be `real_time_decision`.
 */
enum Type: string
{
    case REAL_TIME_DECISION = 'real_time_decision';
}
