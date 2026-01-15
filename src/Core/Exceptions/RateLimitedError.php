<?php

namespace Increase\Core\Exceptions;

class RateLimitedError extends RateLimitException
{
    public const type = 'rate_limited_error';

    /** @var string */
    protected const DESC = 'Increase Rate Limited Error';
}
