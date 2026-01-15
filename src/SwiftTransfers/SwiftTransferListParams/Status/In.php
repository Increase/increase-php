<?php

declare(strict_types=1);

namespace Increase\SwiftTransfers\SwiftTransferListParams\Status;

enum In: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case CANCELED = 'canceled';

    case PENDING_REVIEWING = 'pending_reviewing';

    case REQUIRES_ATTENTION = 'requires_attention';

    case PENDING_INITIATING = 'pending_initiating';

    case INITIATED = 'initiated';

    case REJECTED = 'rejected';

    case RETURNED = 'returned';
}
