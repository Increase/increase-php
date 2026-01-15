<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransferListParams\Status;

enum In: string
{
    case PENDING = 'pending';

    case DECLINED = 'declined';

    case ACCEPTED = 'accepted';

    case RETURNED = 'returned';
}
