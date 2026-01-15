<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerQualityServices\CardholderCancellation;

/**
 * Accepted by merchant.
 */
enum AcceptedByMerchant: string
{
    case ACCEPTED = 'accepted';

    case NOT_ACCEPTED = 'not_accepted';
}
