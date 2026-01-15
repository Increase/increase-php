<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\AccountTransferInstruction;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the destination account currency.
 */
enum Currency: string
{
    case USD = 'USD';
}
