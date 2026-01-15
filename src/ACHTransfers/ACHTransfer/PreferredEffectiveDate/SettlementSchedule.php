<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer\PreferredEffectiveDate;

/**
 * A schedule by which Increase will choose an effective date for the transfer.
 */
enum SettlementSchedule: string
{
    case SAME_DAY = 'same_day';

    case FUTURE_DATED = 'future_dated';
}
