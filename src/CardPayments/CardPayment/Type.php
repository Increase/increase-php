<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment;

/**
 * A constant representing the object's type. For this resource it will always be `card_payment`.
 */
enum Type: string
{
    case CARD_PAYMENT = 'card_payment';
}
