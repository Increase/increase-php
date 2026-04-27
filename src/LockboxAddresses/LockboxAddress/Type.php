<?php

declare(strict_types=1);

namespace Increase\LockboxAddresses\LockboxAddress;

/**
 * A constant representing the object's type. For this resource it will always be `lockbox_address`.
 */
enum Type: string
{
    case LOCKBOX_ADDRESS = 'lockbox_address';
}
