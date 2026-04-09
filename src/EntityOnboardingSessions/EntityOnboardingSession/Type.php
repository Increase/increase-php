<?php

declare(strict_types=1);

namespace Increase\EntityOnboardingSessions\EntityOnboardingSession;

/**
 * A constant representing the object's type. For this resource it will always be `entity_onboarding_session`.
 */
enum Type: string
{
    case ENTITY_ONBOARDING_SESSION = 'entity_onboarding_session';
}
