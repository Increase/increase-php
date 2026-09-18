<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Fleet;

/**
 * The type of service provided.
 */
enum ServiceType: string
{
    case FULL_SERVICE = 'full_service';

    case SELF_SERVICE = 'self_service';
}
