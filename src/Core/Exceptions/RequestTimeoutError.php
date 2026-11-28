<?php

namespace Increase\Core\Exceptions;

class RequestTimeoutError extends APIStatusException
{
    public const type = 'request_timeout_error';

    /** @var string */
    protected const DESC = 'Increase Request Timeout Error';
}
