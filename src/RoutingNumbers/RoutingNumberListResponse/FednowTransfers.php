<?php

declare(strict_types=1);

namespace Increase\RoutingNumbers\RoutingNumberListResponse;

/**
 * This routing number's support for FedNow Transfers.
 */
enum FednowTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}
