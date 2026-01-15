<?php

namespace Increase\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Increase Rate Limit Exception';
}
