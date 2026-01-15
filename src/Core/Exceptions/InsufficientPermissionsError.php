<?php

namespace Increase\Core\Exceptions;

class InsufficientPermissionsError extends PermissionDeniedException
{
    public const type = 'insufficient_permissions_error';

    /** @var string */
    protected const DESC = 'Increase Insufficient Permissions Error';
}
