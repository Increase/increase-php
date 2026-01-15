<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction;

/**
 * The type of the route this Pending Transaction came through.
 */
enum RouteType: string
{
    case ACCOUNT_NUMBER = 'account_number';

    case CARD = 'card';

    case LOCKBOX = 'lockbox';
}
