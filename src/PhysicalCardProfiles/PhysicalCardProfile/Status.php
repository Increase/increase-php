<?php

declare(strict_types=1);

namespace Increase\PhysicalCardProfiles\PhysicalCardProfile;

/**
 * The status of the Physical Card Profile.
 */
enum Status: string
{
    case PENDING_CREATING = 'pending_creating';

    case PENDING_REVIEWING = 'pending_reviewing';

    case REJECTED = 'rejected';

    case PENDING_SUBMITTING = 'pending_submitting';

    case ACTIVE = 'active';

    case ARCHIVED = 'archived';
}
