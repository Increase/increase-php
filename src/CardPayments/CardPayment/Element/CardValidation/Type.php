<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardValidation;

/**
 * A constant representing the object's type. For this resource it will always be `inbound_card_validation`.
 */
enum Type: string
{
    case INBOUND_CARD_VALIDATION = 'inbound_card_validation';
}
