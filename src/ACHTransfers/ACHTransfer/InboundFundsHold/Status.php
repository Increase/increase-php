<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer\InboundFundsHold;

/**
 * The status of the hold.
 */
enum Status: string
{
    case HELD = 'held';

    case COMPLETE = 'complete';
}
