<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequestListParams\Status;

enum In: string
{
    case PENDING_SUBMISSION = 'pending_submission';

    case FULFILLED = 'fulfilled';

    case PENDING_RESPONSE = 'pending_response';

    case REFUSED = 'refused';
}
