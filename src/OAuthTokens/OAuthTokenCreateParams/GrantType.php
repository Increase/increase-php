<?php

declare(strict_types=1);

namespace Increase\OAuthTokens\OAuthTokenCreateParams;

/**
 * The credential you request in exchange for the code. In Production, this is always `authorization_code`. In Sandbox, you can pass either enum value.
 */
enum GrantType: string
{
    case AUTHORIZATION_CODE = 'authorization_code';

    case PRODUCTION_TOKEN = 'production_token';
}
