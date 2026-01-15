<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

/**
 * A constant representing the object's type. For this resource it will always be `card_dispute`.
 */
enum Type: string
{
    case CARD_DISPUTE = 'card_dispute';
}
