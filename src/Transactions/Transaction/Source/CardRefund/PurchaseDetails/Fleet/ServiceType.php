<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\Fleet;

/**
 * The type of service provided.
 */
enum ServiceType: string
{
    case FULL_SERVICE = 'full_service';

    case SELF_SERVICE = 'self_service';

    case HIGH_SPEED_DISPENSE = 'high_speed_dispense';
}
