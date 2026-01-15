<?php

declare(strict_types=1);

namespace Increase\Accounts\Account;

/**
 * The status of the Account.
 */
enum Status: string
{
    case CLOSED = 'closed';

    case OPEN = 'open';
}
