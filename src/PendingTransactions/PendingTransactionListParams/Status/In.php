<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransactionListParams\Status;

enum In: string
{
    case PENDING = 'pending';

    case COMPLETE = 'complete';
}
