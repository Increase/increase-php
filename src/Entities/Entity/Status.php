<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

/**
 * The status of the entity.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case ARCHIVED = 'archived';

    case DISABLED = 'disabled';
}
