<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction;

/**
 * A constant representing the object's type. For this resource it will always be `transaction`.
 */
enum Type: string
{
    case TRANSACTION = 'transaction';
}
