<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit;

/**
 * The status of the Check Deposit.
 */
enum Status: string
{
    case PENDING = 'pending';

    case SUBMITTED = 'submitted';

    case REJECTED = 'rejected';

    case RETURNED = 'returned';
}
