<?php

declare(strict_types=1);

namespace Increase\PhysicalCardProfiles\PhysicalCardProfileListParams\Status;

enum In: string
{
    case PENDING_CREATING = 'pending_creating';

    case PENDING_REVIEWING = 'pending_reviewing';

    case REJECTED = 'rejected';

    case PENDING_SUBMITTING = 'pending_submitting';

    case ACTIVE = 'active';

    case ARCHIVED = 'archived';
}
