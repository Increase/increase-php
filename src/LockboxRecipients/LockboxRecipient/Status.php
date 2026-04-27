<?php

declare(strict_types=1);

namespace Increase\LockboxRecipients\LockboxRecipient;

/**
 * The status of the Lockbox Recipient.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}
