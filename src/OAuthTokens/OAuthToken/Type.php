<?php

declare(strict_types=1);

namespace Increase\OAuthTokens\OAuthToken;

/**
 * A constant representing the object's type. For this resource it will always be `oauth_token`.
 */
enum Type: string
{
    case OAUTH_TOKEN = 'oauth_token';
}
