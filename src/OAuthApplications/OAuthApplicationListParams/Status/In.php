<?php

declare(strict_types=1);

namespace Increase\OAuthApplications\OAuthApplicationListParams\Status;

enum In: string
{
    case ACTIVE = 'active';

    case DELETED = 'deleted';
}
