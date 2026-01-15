<?php

namespace Increase\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Increase Permission Denied Exception';
}
