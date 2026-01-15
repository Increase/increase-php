<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;

/**
 * The lifecycle status of the transfer.
 */
enum Status: string
{
    case PENDING_CONFIRMING = 'pending_confirming';

    case TIMED_OUT = 'timed_out';

    case CONFIRMED = 'confirmed';

    case DECLINED = 'declined';
}
