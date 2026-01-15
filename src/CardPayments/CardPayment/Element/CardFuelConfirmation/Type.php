<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardFuelConfirmation;

/**
 * A constant representing the object's type. For this resource it will always be `card_fuel_confirmation`.
 */
enum Type: string
{
    case CARD_FUEL_CONFIRMATION = 'card_fuel_confirmation';
}
