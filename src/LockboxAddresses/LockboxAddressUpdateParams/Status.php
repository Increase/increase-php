<?php

declare(strict_types=1);

namespace Increase\LockboxAddresses\LockboxAddressUpdateParams;

/**
 * The status of the Lockbox Address.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}
