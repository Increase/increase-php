<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;

/**
 * How to ship the check. For details on pricing, timing, and restrictions, see https://increase.com/documentation/originating-checks#printing-checks .
 */
enum ShippingMethod: string
{
    case USPS_FIRST_CLASS = 'usps_first_class';

    case FEDEX_OVERNIGHT = 'fedex_overnight';
}
