<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `wire_transfer`.
 */
enum Type: string
{
    case WIRE_TRANSFER = 'wire_transfer';
}
