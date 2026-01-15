<?php

declare(strict_types=1);

namespace Increase\OAuthConnections\OAuthConnection;

/**
 * Whether the connection is active.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
