<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard\Shipment;

/**
 * The status of this shipment.
 */
enum Status: string
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
