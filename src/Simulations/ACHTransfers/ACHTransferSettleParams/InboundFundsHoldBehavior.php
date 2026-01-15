<?php

declare(strict_types=1);

namespace Increase\Simulations\ACHTransfers\ACHTransferSettleParams;

/**
 * The behavior of the inbound funds hold that is created when the ACH Transfer is settled. If no behavior is specified, the inbound funds hold will be released immediately in order for the funds to be available for use.
 */
enum InboundFundsHoldBehavior: string
{
    case RELEASE_IMMEDIATELY = 'release_immediately';

    case RELEASE_ON_DEFAULT_SCHEDULE = 'release_on_default_schedule';
}
