<?php

namespace Increase\Core\Exceptions;

class MalformedRequestError extends BadRequestException
{
    public const type = 'malformed_request_error';

    /** @var string */
    protected const DESC = 'Increase Malformed Request Error';
}
