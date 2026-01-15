<?php

declare(strict_types=1);

namespace Increase\OAuthConnections\OAuthConnection;

/**
 * A constant representing the object's type. For this resource it will always be `oauth_connection`.
 */
enum Type: string
{
    case OAUTH_CONNECTION = 'oauth_connection';
}
