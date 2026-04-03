<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams\AuthorizationControls\SpendingLimit;

/**
 * The interval at which the spending limit is enforced.
 */
enum Interval: string
{
    case ALL_TIME = 'all_time';

    case PER_TRANSACTION = 'per_transaction';

    case PER_DAY = 'per_day';

    case PER_WEEK = 'per_week';

    case PER_MONTH = 'per_month';
}
