<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCardCreateParams\Shipment;

/**
 * When this physical card should be produced by the card printer. The default timeline is the day after the card printer receives the order, except for `FEDEX_PRIORITY_OVERNIGHT` cards, which default to `SAME_DAY`. To use faster production methods, please reach out to [support@increase.com](mailto:support@increase.com).
 */
enum Schedule: string
{
    case NEXT_DAY = 'next_day';

    case SAME_DAY = 'same_day';
}
