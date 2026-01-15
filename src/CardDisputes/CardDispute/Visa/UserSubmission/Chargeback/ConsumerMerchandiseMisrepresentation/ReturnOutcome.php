<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation;

/**
 * Return outcome.
 */
enum ReturnOutcome: string
{
    case NOT_RETURNED = 'not_returned';

    case RETURNED = 'returned';

    case RETURN_ATTEMPTED = 'return_attempted';
}
