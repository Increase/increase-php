<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer\Submission;

/**
 * The settlement schedule the transfer is expected to follow. This expectation takes into account the `effective_date`, `submitted_at`, and the amount of the transfer.
 */
enum ExpectedSettlementSchedule: string
{
    case SAME_DAY = 'same_day';

    case FUTURE_DATED = 'future_dated';
}
