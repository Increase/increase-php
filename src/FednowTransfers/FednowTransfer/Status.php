<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer;

/**
 * The lifecycle status of the transfer.
 */
enum Status: string
{
    case PENDING_SUBMITTING = 'pending_submitting';

    case PENDING_REVIEWING = 'pending_reviewing';

    case CANCELED = 'canceled';

    case REQUIRES_ATTENTION = 'requires_attention';

    case PENDING_APPROVAL = 'pending_approval';

    case PENDING_RESPONSE = 'pending_response';

    case COMPLETE = 'complete';

    case REJECTED = 'rejected';
}
