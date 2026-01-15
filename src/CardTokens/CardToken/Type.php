<?php

declare(strict_types=1);

namespace Increase\CardTokens\CardToken;

/**
 * A constant representing the object's type. For this resource it will always be `card_token`.
 */
enum Type: string
{
    case CARD_TOKEN = 'card_token';
}
