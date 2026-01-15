<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotReceived;

/**
 * Cancellation outcome.
 */
enum CancellationOutcome: string
{
    case CARDHOLDER_CANCELLATION_PRIOR_TO_EXPECTED_RECEIPT = 'cardholder_cancellation_prior_to_expected_receipt';

    case MERCHANT_CANCELLATION = 'merchant_cancellation';

    case NO_CANCELLATION = 'no_cancellation';
}
