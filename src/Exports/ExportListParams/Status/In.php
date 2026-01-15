<?php

declare(strict_types=1);

namespace Increase\Exports\ExportListParams\Status;

enum In: string
{
    case PENDING = 'pending';

    case COMPLETE = 'complete';

    case FAILED = 'failed';
}
