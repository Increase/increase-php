<?php

namespace Increase\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    public const type = 'internal_server_error';

    /** @var string */
    protected const DESC = 'Increase Internal Server Exception';
}
