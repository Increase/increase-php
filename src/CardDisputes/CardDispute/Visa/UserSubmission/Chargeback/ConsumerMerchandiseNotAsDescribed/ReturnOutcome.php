<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed;

/**
 * Return outcome.
 */
enum ReturnOutcome: string
{
    case RETURNED = 'returned';

    case RETURN_ATTEMPTED = 'return_attempted';
}
