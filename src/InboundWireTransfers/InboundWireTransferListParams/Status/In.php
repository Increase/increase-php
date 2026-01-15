<?php

declare(strict_types=1);

namespace Increase\InboundWireTransfers\InboundWireTransferListParams\Status;

enum In: string
{
    case PENDING = 'pending';

    case ACCEPTED = 'accepted';

    case DECLINED = 'declined';

    case REVERSED = 'reversed';
}
