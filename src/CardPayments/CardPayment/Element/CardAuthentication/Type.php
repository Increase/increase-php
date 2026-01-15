<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication;

/**
 * A constant representing the object's type. For this resource it will always be `card_authentication`.
 */
enum Type: string
{
    case CARD_AUTHENTICATION = 'card_authentication';
}
