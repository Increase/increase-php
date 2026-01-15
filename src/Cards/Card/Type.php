<?php

declare(strict_types=1);

namespace Increase\Cards\Card;

/**
 * A constant representing the object's type. For this resource it will always be `card`.
 */
enum Type: string
{
    case CARD = 'card';
}
