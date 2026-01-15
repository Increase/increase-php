<?php

declare(strict_types=1);

namespace Increase\RoutingNumbers\RoutingNumberListResponse;

/**
 * This routing number's support for Wire Transfers.
 */
enum WireTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}
