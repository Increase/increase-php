<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

/**
 * The direction of the transfer.
 */
enum Direction: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';
}
