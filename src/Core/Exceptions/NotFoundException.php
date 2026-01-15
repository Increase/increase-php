<?php

namespace Increase\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Increase Not Found Exception';
}
