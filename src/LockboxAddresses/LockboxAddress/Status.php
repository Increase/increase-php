<?php

declare(strict_types=1);

namespace Increase\LockboxAddresses\LockboxAddress;

/**
 * The status of the Lockbox Address.
 */
enum Status: string
{
    case PENDING = 'pending';

    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}
