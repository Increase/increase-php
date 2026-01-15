<?php

declare(strict_types=1);

namespace Increase\Entities\EntityListParams\Status;

enum In: string
{
    case ACTIVE = 'active';

    case ARCHIVED = 'archived';

    case DISABLED = 'disabled';
}
