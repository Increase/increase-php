<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit\DepositAcceptance;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's currency.
 */
enum Currency: string
{
    case USD = 'USD';
}
