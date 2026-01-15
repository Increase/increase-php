<?php

namespace Increase\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Increase Authentication Exception';
}
