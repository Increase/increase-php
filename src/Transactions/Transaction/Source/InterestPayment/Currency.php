<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\InterestPayment;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction currency.
 */
enum Currency: string
{
    case USD = 'USD';
}
