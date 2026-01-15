<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard\Shipment\Tracking\Update;

/**
 * The type of tracking event.
 */
enum Category: string
{
    case IN_TRANSIT = 'in_transit';

    case PROCESSED_FOR_DELIVERY = 'processed_for_delivery';

    case DELIVERED = 'delivered';

    case DELIVERY_ISSUE = 'delivery_issue';

    case RETURNED_TO_SENDER = 'returned_to_sender';
}
