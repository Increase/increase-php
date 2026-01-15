<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits\InboundCheckDeposit;

/**
 * The status of the Inbound Check Deposit.
 */
enum Status: string
{
    case PENDING = 'pending';

    case ACCEPTED = 'accepted';

    case DECLINED = 'declined';

    case RETURNED = 'returned';

    case REQUIRES_ATTENTION = 'requires_attention';
}
