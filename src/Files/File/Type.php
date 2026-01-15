<?php

declare(strict_types=1);

namespace Increase\Files\File;

/**
 * A constant representing the object's type. For this resource it will always be `file`.
 */
enum Type: string
{
    case FILE = 'file';
}
