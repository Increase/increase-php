<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Transaction's currency. This will match the currency on the Transaction's Account.
 */
enum Currency: string
{
    case USD = 'USD';
}
