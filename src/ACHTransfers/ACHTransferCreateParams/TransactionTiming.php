<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams;

/**
 * The timing of the transaction.
 */
enum TransactionTiming: string
{
    case SYNCHRONOUS = 'synchronous';

    case ASYNCHRONOUS = 'asynchronous';
}
