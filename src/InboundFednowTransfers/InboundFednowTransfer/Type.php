<?php

declare(strict_types=1);

namespace Increase\InboundFednowTransfers\InboundFednowTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_fednow_transfer`.
 */
enum Type: string
{
    case INBOUND_FEDNOW_TRANSFER = 'inbound_fednow_transfer';
}
