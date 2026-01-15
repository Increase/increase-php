<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesNotAsDescribed\CardholderCancellation;

/**
 * Accepted by merchant.
 */
enum AcceptedByMerchant: string
{
    case ACCEPTED = 'accepted';

    case NOT_ACCEPTED = 'not_accepted';
}
