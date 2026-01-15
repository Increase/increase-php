<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `ach_transfer`.
 */
enum Type: string
{
    case ACH_TRANSFER = 'ach_transfer';
}
