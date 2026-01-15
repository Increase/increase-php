<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferListParams\Status;

enum In: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case PENDING_TRANSFER_SESSION_CONFIRMATION = 'pending_transfer_session_confirmation';

    case CANCELED = 'canceled';

    case PENDING_SUBMISSION = 'pending_submission';

    case PENDING_REVIEWING = 'pending_reviewing';

    case REQUIRES_ATTENTION = 'requires_attention';

    case REJECTED = 'rejected';

    case SUBMITTED = 'submitted';

    case RETURNED = 'returned';
}
