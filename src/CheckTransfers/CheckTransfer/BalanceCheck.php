<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

/**
 * How the account's available balance should be checked.
 */
enum BalanceCheck: string
{
    case FULL = 'full';

    case NONE = 'none';
}
