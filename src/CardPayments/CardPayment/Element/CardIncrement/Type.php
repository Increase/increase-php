<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardIncrement;

/**
 * A constant representing the object's type. For this resource it will always be `card_increment`.
 */
enum Type: string
{
    case CARD_INCREMENT = 'card_increment';
}
