<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices\GuaranteedReservation;

/**
 * Explanation.
 */
enum Explanation: string
{
    case CARDHOLDER_CANCELED_PRIOR_TO_SERVICE = 'cardholder_canceled_prior_to_service';

    case CARDHOLDER_CANCELLATION_ATTEMPT_WITHIN_24_HOURS_OF_CONFIRMATION = 'cardholder_cancellation_attempt_within_24_hours_of_confirmation';

    case MERCHANT_BILLED_NO_SHOW = 'merchant_billed_no_show';
}
