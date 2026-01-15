<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction;

/**
 * A constant representing the object's type. For this resource it will always be `declined_transaction`.
 */
enum Type: string
{
    case DECLINED_TRANSACTION = 'declined_transaction';
}
