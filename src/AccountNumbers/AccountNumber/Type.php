<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumber;

/**
 * A constant representing the object's type. For this resource it will always be `account_number`.
 */
enum Type: string
{
    case ACCOUNT_NUMBER = 'account_number';
}
