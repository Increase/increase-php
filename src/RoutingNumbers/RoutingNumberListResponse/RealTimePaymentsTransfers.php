<?php

declare(strict_types=1);

namespace Increase\RoutingNumbers\RoutingNumberListResponse;

/**
 * This routing number's support for Real-Time Payments Transfers.
 */
enum RealTimePaymentsTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}
