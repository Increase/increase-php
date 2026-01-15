<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation;

/**
 * A constant representing the object's type. For this resource it will always be `card_validation`.
 */
enum Type: string
{
    case CARD_VALIDATION = 'card_validation';
}
