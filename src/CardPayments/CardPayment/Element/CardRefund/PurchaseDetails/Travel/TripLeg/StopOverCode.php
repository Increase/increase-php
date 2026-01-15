<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Travel\TripLeg;

/**
 * Indicates whether a stopover is allowed on this ticket.
 */
enum StopOverCode: string
{
    case NONE = 'none';

    case STOP_OVER_ALLOWED = 'stop_over_allowed';

    case STOP_OVER_NOT_ALLOWED = 'stop_over_not_allowed';
}
