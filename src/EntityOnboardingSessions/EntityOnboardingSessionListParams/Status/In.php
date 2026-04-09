<?php

declare(strict_types=1);

namespace Increase\EntityOnboardingSessions\EntityOnboardingSessionListParams\Status;

enum In: string
{
    case ACTIVE = 'active';

    case EXPIRED = 'expired';
}
