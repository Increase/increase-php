<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

/**
 * A constant representing the object's type. For this resource it will always be `export`.
 */
enum Type: string
{
    case EXPORT = 'export';
}
