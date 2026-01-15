<?php

declare(strict_types=1);

namespace Increase\Groups\Group;

/**
 * A constant representing the object's type. For this resource it will always be `group`.
 */
enum Type: string
{
    case GROUP = 'group';
}
