<?php

declare(strict_types=1);

namespace Increase\RoutingNumbers\RoutingNumberListResponse;

/**
 * This routing number's support for ACH Transfers.
 */
enum ACHTransfers: string
{
    case SUPPORTED = 'supported';

    case NOT_SUPPORTED = 'not_supported';
}
