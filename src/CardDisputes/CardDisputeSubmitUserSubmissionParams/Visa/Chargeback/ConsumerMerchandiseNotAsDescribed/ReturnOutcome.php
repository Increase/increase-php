<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed;

/**
 * Return outcome.
 */
enum ReturnOutcome: string
{
    case RETURNED = 'returned';

    case RETURN_ATTEMPTED = 'return_attempted';
}
