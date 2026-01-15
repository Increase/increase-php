<?php

declare(strict_types=1);

namespace Increase\AccountTransfers\AccountTransfer;

/**
 * The lifecycle status of the transfer.
 */
enum Status: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case CANCELED = 'canceled';

    case COMPLETE = 'complete';
}
