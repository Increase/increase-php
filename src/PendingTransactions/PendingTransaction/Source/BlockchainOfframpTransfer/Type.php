<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\BlockchainOfframpTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `blockchain_offramp_transfer`.
 */
enum Type: string
{
    case BLOCKCHAIN_OFFRAMP_TRANSFER = 'blockchain_offramp_transfer';
}
