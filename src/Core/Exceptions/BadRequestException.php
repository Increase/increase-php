<?php

namespace Increase\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Increase Bad Request Exception';
}
