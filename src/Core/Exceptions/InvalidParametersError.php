<?php

namespace Increase\Core\Exceptions;

class InvalidParametersError extends BadRequestException
{
    public const type = 'invalid_parameters_error';

    /** @var string */
    protected const DESC = 'Increase Invalid Parameters Error';
}
