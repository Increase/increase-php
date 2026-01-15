<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardBalanceInquiry;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the account's currency.
 */
enum Currency: string
{
    case USD = 'USD';
}
