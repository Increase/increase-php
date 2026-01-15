<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction;

/**
 * Whether the Pending Transaction has been confirmed and has an associated Transaction.
 */
enum Status: string
{
    case PENDING = 'pending';

    case COMPLETE = 'complete';
}
