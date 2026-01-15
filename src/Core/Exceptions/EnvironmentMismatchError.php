<?php

namespace Increase\Core\Exceptions;

class EnvironmentMismatchError extends PermissionDeniedException
{
    public const type = 'environment_mismatch_error';

    /** @var string */
    protected const DESC = 'Increase Environment Mismatch Error';
}
