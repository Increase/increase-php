<?php

declare(strict_types=1);

namespace Increase\InboundFednowTransfers\InboundFednowTransfer;

/**
 * The lifecycle status of the transfer.
 */
enum Status: string
{
    case PENDING_CONFIRMING = 'pending_confirming';

    case TIMED_OUT = 'timed_out';

    case CONFIRMED = 'confirmed';

    case DECLINED = 'declined';

    case REQUIRES_ATTENTION = 'requires_attention';
}
