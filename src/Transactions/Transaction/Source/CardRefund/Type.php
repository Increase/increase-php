<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund;

/**
 * A constant representing the object's type. For this resource it will always be `card_refund`.
 */
enum Type: string
{
    case CARD_REFUND = 'card_refund';
}
