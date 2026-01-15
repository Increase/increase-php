<?php

namespace Increase\Core\Exceptions;

class APIMethodNotFoundError extends NotFoundException
{
    public const type = 'api_method_not_found_error';

    /** @var string */
    protected const DESC = 'Increase API Method Not Found Error';
}
