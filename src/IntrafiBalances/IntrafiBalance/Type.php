<?php

declare(strict_types=1);

namespace Increase\IntrafiBalances\IntrafiBalance;

/**
 * A constant representing the object's type. For this resource it will always be `intrafi_balance`.
 */
enum Type: string
{
    case INTRAFI_BALANCE = 'intrafi_balance';
}
