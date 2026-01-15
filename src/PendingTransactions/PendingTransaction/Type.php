<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction;

/**
 * A constant representing the object's type. For this resource it will always be `pending_transaction`.
 */
enum Type: string
{
    case PENDING_TRANSACTION = 'pending_transaction';
}
