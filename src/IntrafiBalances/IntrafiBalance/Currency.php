<?php

declare(strict_types=1);

namespace Increase\IntrafiBalances\IntrafiBalance;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the account currency.
 */
enum Currency: string
{
    case USD = 'USD';
}
