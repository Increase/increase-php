<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement;

/**
 * A constant representing the object's type. For this resource it will always be `card_settlement`.
 */
enum Type: string
{
    case CARD_SETTLEMENT = 'card_settlement';
}
