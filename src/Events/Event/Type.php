<?php

declare(strict_types=1);

namespace Increase\Events\Event;

/**
 * A constant representing the object's type. For this resource it will always be `event`.
 */
enum Type: string
{
    case EVENT = 'event';
}
