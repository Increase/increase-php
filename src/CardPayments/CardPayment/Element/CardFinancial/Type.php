<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardFinancial;

/**
 * A constant representing the object's type. For this resource it will always be `card_financial`.
 */
enum Type: string
{
    case CARD_FINANCIAL = 'card_financial';
}
