<?php

declare(strict_types=1);

namespace Increase\SwiftTransfers\SwiftTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `swift_transfer`.
 */
enum Type: string
{
    case SWIFT_TRANSFER = 'swift_transfer';
}
