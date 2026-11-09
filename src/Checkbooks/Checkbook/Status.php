<?php

declare(strict_types=1);

namespace Increase\Checkbooks\Checkbook;

/**
 * The lifecycle status of the Checkbook.
 */
enum Status: string
{
    case PENDING_SUBMISSION = 'pending_submission';

    case PENDING_MAILING = 'pending_mailing';

    case MAILED = 'mailed';

    case STOPPED = 'stopped';
}
