<?php

namespace Increase\Core\Exceptions;

class ObjectNotFoundError extends NotFoundException
{
    public const type = 'object_not_found_error';

    /** @var string */
    protected const DESC = 'Increase Object Not Found Error';
}
