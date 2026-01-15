<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardReversal;

/**
 * A constant representing the object's type. For this resource it will always be `card_reversal`.
 */
enum Type: string
{
    case CARD_REVERSAL = 'card_reversal';
}
