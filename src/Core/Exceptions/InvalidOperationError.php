<?php

namespace Increase\Core\Exceptions;

class InvalidOperationError extends ConflictException
{
    public const type = 'invalid_operation_error';

    /** @var string */
    protected const DESC = 'Increase Invalid Operation Error';
}
