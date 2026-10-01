<?php

declare(strict_types=1);

namespace Increase\Cards\CardDetailsToken;

/**
 * A constant representing the object's type. For this resource it will always be `card_details_token`.
 */
enum Type: string
{
    case CARD_DETAILS_TOKEN = 'card_details_token';
}
