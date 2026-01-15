<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived;

/**
 * Delivery issue.
 */
enum DeliveryIssue: string
{
    case DELAYED = 'delayed';

    case DELIVERED_TO_WRONG_LOCATION = 'delivered_to_wrong_location';
}
