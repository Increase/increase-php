<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard;

/**
 * A constant representing the object's type. For this resource it will always be `physical_card`.
 */
enum Type: string
{
    case PHYSICAL_CARD = 'physical_card';
}
