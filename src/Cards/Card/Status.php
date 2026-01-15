<?php

declare(strict_types=1);

namespace Increase\Cards\Card;

/**
 * This indicates if payments can be made with the card.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}
