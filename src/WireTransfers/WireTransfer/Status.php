<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer;

/**
 * The lifecycle status of the transfer.
 */
enum Status: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case CANCELED = 'canceled';

    case PENDING_REVIEWING = 'pending_reviewing';

    case REJECTED = 'rejected';

    case REQUIRES_ATTENTION = 'requires_attention';

    case PENDING_CREATING = 'pending_creating';

    case REVERSED = 'reversed';

    case SUBMITTED = 'submitted';

    case COMPLETE = 'complete';
}
