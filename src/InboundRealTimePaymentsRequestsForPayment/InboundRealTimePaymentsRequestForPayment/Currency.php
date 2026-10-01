<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment;

/**
 * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code of the requested currency. This will always be "USD" for a Real-Time Payments request for payment.
 */
enum Currency: string
{
    case USD = 'USD';
}
