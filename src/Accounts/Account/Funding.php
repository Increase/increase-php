<?php

declare(strict_types=1);

namespace Increase\Accounts\Account;

/**
 * Whether the Account is funded by a loan or by deposits.
 */
enum Funding: string
{
    case LOAN = 'loan';

    case DEPOSITS = 'deposits';
}
