<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfile;

/**
 * The status of the Card Profile.
 */
enum Status: string
{
    case PENDING = 'pending';

    case REJECTED = 'rejected';

    case ACTIVE = 'active';

    case ARCHIVED = 'archived';
}
