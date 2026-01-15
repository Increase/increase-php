<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts\BookkeepingBalanceLookup;

/**
 * A constant representing the object's type. For this resource it will always be `bookkeeping_balance_lookup`.
 */
enum Type: string
{
    case BOOKKEEPING_BALANCE_LOOKUP = 'bookkeeping_balance_lookup';
}
