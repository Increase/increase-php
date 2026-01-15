<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `real_time_payments_transfer`.
 */
enum Type: string
{
    case REAL_TIME_PAYMENTS_TRANSFER = 'real_time_payments_transfer';
}
