<?php

declare(strict_types=1);

namespace Increase\OAuthApplications\OAuthApplication;

/**
 * Whether the application is active.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DELETED = 'deleted';
}
