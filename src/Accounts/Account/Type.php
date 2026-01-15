<?php

declare(strict_types=1);

namespace Increase\Accounts\Account;

/**
 * A constant representing the object's type. For this resource it will always be `account`.
 */
enum Type: string
{
    case ACCOUNT = 'account';
}
