<?php

declare(strict_types=1);

namespace Increase\InboundWireTransfers\InboundWireTransfer;

/**
 * The status of the transfer.
 */
enum Status: string
{
    case PENDING = 'pending';

    case ACCEPTED = 'accepted';

    case DECLINED = 'declined';

    case REVERSED = 'reversed';
}
