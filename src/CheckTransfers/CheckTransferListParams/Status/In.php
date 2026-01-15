<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferListParams\Status;

enum In: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case CANCELED = 'canceled';

    case PENDING_SUBMISSION = 'pending_submission';

    case REQUIRES_ATTENTION = 'requires_attention';

    case REJECTED = 'rejected';

    case PENDING_MAILING = 'pending_mailing';

    case MAILED = 'mailed';

    case DEPOSITED = 'deposited';

    case STOPPED = 'stopped';

    case RETURNED = 'returned';
}
