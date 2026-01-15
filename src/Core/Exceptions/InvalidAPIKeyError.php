<?php

namespace Increase\Core\Exceptions;

class InvalidAPIKeyError extends AuthenticationException
{
    public const type = 'invalid_api_key_error';

    /** @var string */
    protected const DESC = 'Increase Invalid API Key Error';
}
