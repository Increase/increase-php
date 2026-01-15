<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthorizationExpiration;

/**
 * A constant representing the object's type. For this resource it will always be `card_authorization_expiration`.
 */
enum Type: string
{
    case CARD_AUTHORIZATION_EXPIRATION = 'card_authorization_expiration';
}
