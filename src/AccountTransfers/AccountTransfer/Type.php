<?php

declare(strict_types=1);

namespace Increase\AccountTransfers\AccountTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `account_transfer`.
 */
enum Type: string
{
    case ACCOUNT_TRANSFER = 'account_transfer';
}
