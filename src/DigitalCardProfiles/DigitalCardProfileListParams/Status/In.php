<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfileListParams\Status;

enum In: string
{
    case PENDING = 'pending';

    case REJECTED = 'rejected';

    case ACTIVE = 'active';

    case ARCHIVED = 'archived';
}
