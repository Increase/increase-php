<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed;

/**
 * Return outcome.
 */
enum ReturnOutcome: string
{
    case NOT_RETURNED = 'not_returned';

    case RETURNED = 'returned';

    case RETURN_ATTEMPTED = 'return_attempted';
}
