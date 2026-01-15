<?php

namespace Increase\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Increase Unprocessable Entity Exception';
}
