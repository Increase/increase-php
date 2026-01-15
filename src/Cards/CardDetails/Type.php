<?php

declare(strict_types=1);

namespace Increase\Cards\CardDetails;

/**
 * A constant representing the object's type. For this resource it will always be `card_details`.
 */
enum Type: string
{
    case CARD_DETAILS = 'card_details';
}
