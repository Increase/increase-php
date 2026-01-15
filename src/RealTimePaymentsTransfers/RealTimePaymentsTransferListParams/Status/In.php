<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\Status;

enum In: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case CANCELED = 'canceled';

    case PENDING_REVIEWING = 'pending_reviewing';

    case REQUIRES_ATTENTION = 'requires_attention';

    case REJECTED = 'rejected';

    case PENDING_SUBMISSION = 'pending_submission';

    case SUBMITTED = 'submitted';

    case COMPLETE = 'complete';
}
