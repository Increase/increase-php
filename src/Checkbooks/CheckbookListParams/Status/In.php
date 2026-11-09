<?php

declare(strict_types=1);

namespace Increase\Checkbooks\CheckbookListParams\Status;

enum In: string
{
    case PENDING_SUBMISSION = 'pending_submission';

    case PENDING_MAILING = 'pending_mailing';

    case MAILED = 'mailed';

    case STOPPED = 'stopped';
}
