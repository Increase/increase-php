<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer\Settlement;

/**
 * The settlement schedule this transfer follows.
 */
enum SettlementSchedule: string
{
    case SAME_DAY = 'same_day';

    case FUTURE_DATED = 'future_dated';
}
