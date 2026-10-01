<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCancelParams;

/**
 * The reason the request for payment is being canceled. Defaults to `requested_by_customer`.
 */
enum Reason: string
{
    case REQUESTED_BY_CUSTOMER = 'requested_by_customer';

    case PAID_BY_OTHER_MEANS = 'paid_by_other_means';

    case DUPLICATE = 'duplicate';

    case WRONG_AMOUNT = 'wrong_amount';
}
