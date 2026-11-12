<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardDisputeProvisionalCredit;

/**
 * Whether the provisional credit was provided or reversed.
 */
enum EventType: string
{
    case PROVIDED = 'provided';

    case REVERSED = 'reversed';
}
