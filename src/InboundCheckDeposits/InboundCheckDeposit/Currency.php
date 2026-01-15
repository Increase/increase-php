<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits\InboundCheckDeposit;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the deposit.
 */
enum Currency: string
{
    case USD = 'USD';
}
