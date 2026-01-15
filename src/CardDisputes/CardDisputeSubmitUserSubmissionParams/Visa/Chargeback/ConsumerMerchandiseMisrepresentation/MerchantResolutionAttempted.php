<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseMisrepresentation;

/**
 * Merchant resolution attempted.
 */
enum MerchantResolutionAttempted: string
{
    case ATTEMPTED = 'attempted';

    case PROHIBITED_BY_LOCAL_LAW = 'prohibited_by_local_law';
}
