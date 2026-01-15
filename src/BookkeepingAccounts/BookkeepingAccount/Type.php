<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts\BookkeepingAccount;

/**
 * A constant representing the object's type. For this resource it will always be `bookkeeping_account`.
 */
enum Type: string
{
    case BOOKKEEPING_ACCOUNT = 'bookkeeping_account';
}
