<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

/**
 * The status of the transfer.
 */
enum Status: string
{
    case PENDING = 'pending';

    case DECLINED = 'declined';

    case ACCEPTED = 'accepted';

    case RETURNED = 'returned';
}
