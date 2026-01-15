<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardSettlement\Interchange;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the interchange reimbursement.
 */
enum Currency: string
{
    case USD = 'USD';
}
