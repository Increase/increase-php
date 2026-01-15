<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransfer;

/**
 * A constant representing the object's type. For this resource it will always be `card_push_transfer`.
 */
enum Type: string
{
    case CARD_PUSH_TRANSFER = 'card_push_transfer';
}
