<?php

declare(strict_types=1);

namespace Increase\CheckbookChecks\CheckbookCheck;

/**
 * The status of the Checkbook Check.
 */
enum Status: string
{
    case PENDING_DEPOSIT = 'pending_deposit';

    case DEPOSITED = 'deposited';

    case STOPPED = 'stopped';

    case REQUIRES_ATTENTION = 'requires_attention';
}
