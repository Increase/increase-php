<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit\InboundFundsHold;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_funds_hold`.
 */
enum Type: string
{
    case INBOUND_FUNDS_HOLD = 'inbound_funds_hold';
}
