<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequest;

/**
 * The lifecycle status of the drawdown request.
 */
enum Status: string
{
    case PENDING_SUBMISSION = 'pending_submission';

    case PENDING_RESPONSE = 'pending_response';

    case FULFILLED = 'fulfilled';

    case REFUSED = 'refused';
}
