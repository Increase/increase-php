<?php

declare(strict_types=1);

namespace Increase\OAuthApplications\OAuthApplication;

/**
 * A constant representing the object's type. For this resource it will always be `oauth_application`.
 */
enum Type: string
{
    case OAUTH_APPLICATION = 'oauth_application';
}
