<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard;

/**
 * The status of the Physical Card.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}
