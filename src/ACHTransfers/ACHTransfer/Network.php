<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

/**
 * The transfer's network.
 */
enum Network: string
{
    case ACH = 'ach';
}
