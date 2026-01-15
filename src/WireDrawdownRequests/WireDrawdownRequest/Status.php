<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequest;

/**
 * The lifecycle status of the drawdown request.
 */
enum Status: string
{
    case PENDING_SUBMISSION = 'pending_submission';

    case FULFILLED = 'fulfilled';

    case PENDING_RESPONSE = 'pending_response';

    case REFUSED = 'refused';
}
