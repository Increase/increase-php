<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `check_transfer`.
 */
enum Type: string
{
    case CHECK_TRANSFER = 'check_transfer';
}
