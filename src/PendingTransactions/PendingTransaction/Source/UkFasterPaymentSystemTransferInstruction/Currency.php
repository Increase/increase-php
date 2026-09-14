<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\UkFasterPaymentSystemTransferInstruction;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the transfer's currency. This is always `GBP`.
 */
enum Currency: string
{
    case GBP = 'GBP';
}
