<?php

declare(strict_types=1);

namespace Increase\Checkbooks\Checkbook;

/**
 * A constant representing the object's type. For this resource it will always be `checkbook`.
 */
enum Type: string
{
    case CHECKBOOK = 'checkbook';
}
