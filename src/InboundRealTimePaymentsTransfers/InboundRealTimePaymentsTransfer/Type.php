<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_real_time_payments_transfer`.
 */
enum Type: string
{
    case INBOUND_REAL_TIME_PAYMENTS_TRANSFER = 'inbound_real_time_payments_transfer';
}
