<?php

declare(strict_types=1);

namespace Increase\LockboxRecipients\LockboxRecipient;

/**
 * A constant representing the object's type. For this resource it will always be `lockbox_recipient`.
 */
enum Type: string
{
    case LOCKBOX_RECIPIENT = 'lockbox_recipient';
}
