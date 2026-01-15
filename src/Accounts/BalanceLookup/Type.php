<?php

declare(strict_types=1);

namespace Increase\Accounts\BalanceLookup;

/**
 * A constant representing the object's type. For this resource it will always be `balance_lookup`.
 */
enum Type: string
{
    case BALANCE_LOOKUP = 'balance_lookup';
}
