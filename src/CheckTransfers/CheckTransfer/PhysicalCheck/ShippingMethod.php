<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\PhysicalCheck;

/**
 * The shipping method for the check.
 */
enum ShippingMethod: string
{
    case USPS_FIRST_CLASS = 'usps_first_class';

    case FEDEX_OVERNIGHT = 'fedex_overnight';
}
