<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams\EntityCsv\Status;

enum In: string
{
    case ACTIVE = 'active';

    case ARCHIVED = 'archived';

    case DISABLED = 'disabled';
}
