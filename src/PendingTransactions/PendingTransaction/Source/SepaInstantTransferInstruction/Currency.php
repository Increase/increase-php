<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\SepaInstantTransferInstruction;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the transfer's currency. This is always `EUR`.
 */
enum Currency: string
{
    case EUR = 'EUR';
}
