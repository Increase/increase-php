<?php

declare(strict_types=1);

namespace Increase\FileLinks\FileLink;

/**
 * A constant representing the object's type. For this resource it will always be `file_link`.
 */
enum Type: string
{
    case FILE_LINK = 'file_link';
}
