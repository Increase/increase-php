<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the Declined Transaction's currency. This will match the currency on the Declined Transaction's Account.
 */
enum Currency: string
{
    case USD = 'USD';
}
