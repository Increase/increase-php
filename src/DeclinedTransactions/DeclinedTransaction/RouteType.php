<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction;

/**
 * The type of the route this Declined Transaction came through.
 */
enum RouteType: string
{
    case ACCOUNT_NUMBER = 'account_number';

    case CARD = 'card';

    case LOCKBOX = 'lockbox';
}
