<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundRealTimePaymentsTransferDecline;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the declined transfer's currency. This will always be "USD" for a Real-Time Payments transfer.
 */
enum Currency: string
{
    case USD = 'USD';
}
