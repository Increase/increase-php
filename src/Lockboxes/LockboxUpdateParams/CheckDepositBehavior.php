<?php

declare(strict_types=1);

namespace Increase\Lockboxes\LockboxUpdateParams;

/**
 * This indicates if checks mailed to this lockbox will be deposited.
 */
enum CheckDepositBehavior: string
{
    case ENABLED = 'enabled';

    case DISABLED = 'disabled';

    case PEND_FOR_PROCESSING = 'pend_for_processing';
}
