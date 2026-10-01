<?php

declare(strict_types=1);

namespace Increase\PhysicalCheckBatches\PhysicalCheckBatch;

/**
 * The shipping method for the parcel.
 */
enum ShippingMethod: string
{
    case USPS_FIRST_CLASS = 'usps_first_class';

    case FEDEX_OVERNIGHT = 'fedex_overnight';
}
