<?php

declare(strict_types=1);

namespace Increase\Lockboxes\Lockbox;

/**
 * A constant representing the object's type. For this resource it will always be `lockbox`.
 */
enum Type: string
{
    case LOCKBOX = 'lockbox';
}
