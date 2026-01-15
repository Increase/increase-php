<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard\Shipment;

/**
 * The shipping method.
 */
enum Method: string
{
    case USPS = 'usps';

    case FEDEX_PRIORITY_OVERNIGHT = 'fedex_priority_overnight';

    case FEDEX_2_DAY = 'fedex_2_day';

    case DHL_WORLDWIDE_EXPRESS = 'dhl_worldwide_express';
}
