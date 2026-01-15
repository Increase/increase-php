<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDepositRejection;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the check's currency.
 */
enum Currency: string
{
    case USD = 'USD';
}
