<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `fednow_transfer`.
 */
enum Type: string
{
    case FEDNOW_TRANSFER = 'fednow_transfer';
}
