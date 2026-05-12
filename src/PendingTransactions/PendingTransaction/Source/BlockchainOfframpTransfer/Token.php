<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransfer;

/**
 * The token that was received.
 */
enum Token: string
{
    case USDC = 'usdc';
}
