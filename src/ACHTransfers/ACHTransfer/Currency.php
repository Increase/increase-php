<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For ACH transfers this is always equal to `usd`.
 */
enum Currency: string
{
    case USD = 'USD';
}
