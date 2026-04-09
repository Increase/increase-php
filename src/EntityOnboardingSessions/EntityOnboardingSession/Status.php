<?php

declare(strict_types=1);

namespace Increase\EntityOnboardingSessions\EntityOnboardingSession;

/**
 * The status of the onboarding session.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case EXPIRED = 'expired';
}
