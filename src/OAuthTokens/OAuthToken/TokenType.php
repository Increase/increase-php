<?php

declare(strict_types=1);

namespace Increase\OAuthTokens\OAuthToken;

/**
 * The type of OAuth token.
 */
enum TokenType: string
{
    case BEARER = 'bearer';
}
