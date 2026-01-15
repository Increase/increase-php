<?php

declare(strict_types=1);

namespace Increase\Simulations\PhysicalCards\PhysicalCardAdvanceShipmentParams;

/**
 * The shipment status to move the Physical Card to.
 */
enum ShipmentStatus: string
{
    case PENDING = 'pending';

    case CANCELED = 'canceled';

    case SUBMITTED = 'submitted';

    case ACKNOWLEDGED = 'acknowledged';

    case REJECTED = 'rejected';

    case SHIPPED = 'shipped';

    case RETURNED = 'returned';

    case REQUIRES_ATTENTION = 'requires_attention';
}
