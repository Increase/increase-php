<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

/**
 * The status of the Export.
 */
enum Status: string
{
    case PENDING = 'pending';

    case COMPLETE = 'complete';

    case FAILED = 'failed';
}
