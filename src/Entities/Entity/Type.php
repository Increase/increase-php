<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

/**
 * A constant representing the object's type. For this resource it will always be `entity`.
 */
enum Type: string
{
    case ENTITY = 'entity';
}
