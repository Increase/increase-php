<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransfer;

/**
 * The lifecycle status of the transfer.
 */
enum Status: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case CANCELED = 'canceled';

    case PENDING_REVIEWING = 'pending_reviewing';

    case REQUIRES_ATTENTION = 'requires_attention';

    case PENDING_SUBMISSION = 'pending_submission';

    case SUBMITTED = 'submitted';

    case COMPLETE = 'complete';

    case DECLINED = 'declined';
}
