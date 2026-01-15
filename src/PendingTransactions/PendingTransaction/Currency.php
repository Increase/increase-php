<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Pending Transaction's currency. This will match the currency on the Pending Transaction's Account.
 */
enum Currency: string
{
    case USD = 'USD';
}
