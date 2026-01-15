<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived;

/**
 * Delivery issue.
 */
enum DeliveryIssue: string
{
    case DELAYED = 'delayed';

    case DELIVERED_TO_WRONG_LOCATION = 'delivered_to_wrong_location';
}
