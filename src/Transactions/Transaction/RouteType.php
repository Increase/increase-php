<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction;

/**
 * The type of the route this Transaction came through.
 */
enum RouteType: string
{
    case ACCOUNT_NUMBER = 'account_number';

    case CARD = 'card';

    case LOCKBOX = 'lockbox';
}
