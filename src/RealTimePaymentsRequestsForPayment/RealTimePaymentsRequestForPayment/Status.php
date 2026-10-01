<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment;

/**
 * The lifecycle status of the request for payment.
 */
enum Status: string
{
    case PENDING_SUBMISSION = 'pending_submission';

    case PENDING_RESPONSE = 'pending_response';

    case REJECTED = 'rejected';

    case ACCEPTED = 'accepted';

    case REFUSED = 'refused';

    case FULFILLED = 'fulfilled';

    case CANCELED = 'canceled';
}
