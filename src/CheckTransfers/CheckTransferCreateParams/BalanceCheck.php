<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams;

/**
 * How the account's available balance should be checked. If omitted, the default behavior is `balance_check: full`.
 */
enum BalanceCheck: string
{
    case FULL = 'full';

    case NONE = 'none';
}
