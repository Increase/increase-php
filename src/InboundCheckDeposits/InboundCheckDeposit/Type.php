<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits\InboundCheckDeposit;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_check_deposit`.
 */
enum Type: string
{
    case INBOUND_CHECK_DEPOSIT = 'inbound_check_deposit';
}
