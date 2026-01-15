<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_ach_transfer`.
 */
enum Type: string
{
    case INBOUND_ACH_TRANSFER = 'inbound_ach_transfer';
}
