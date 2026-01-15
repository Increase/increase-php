<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit;

/**
 * A constant representing the object's type. For this resource it will always be `check_deposit`.
 */
enum Type: string
{
    case CHECK_DEPOSIT = 'check_deposit';
}
