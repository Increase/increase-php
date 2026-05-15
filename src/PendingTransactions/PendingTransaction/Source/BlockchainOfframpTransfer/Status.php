<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransfer;

/**
 * The lifecycle status of the transfer.
 */
enum Status: string
{
    case PENDING_SETTLEMENT = 'pending_settlement';

    case SETTLED = 'settled';
}
