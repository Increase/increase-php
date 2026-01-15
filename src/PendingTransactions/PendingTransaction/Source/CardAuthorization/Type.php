<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\CardAuthorization;

/**
 * A constant representing the object's type. For this resource it will always be `card_authorization`.
 */
enum Type: string
{
    case CARD_AUTHORIZATION = 'card_authorization';
}
