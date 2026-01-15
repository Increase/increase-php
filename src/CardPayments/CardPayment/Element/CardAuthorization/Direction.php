<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthorization;

/**
 * The direction describes the direction the funds will move, either from the cardholder to the merchant or from the merchant to the cardholder.
 */
enum Direction: string
{
    case SETTLEMENT = 'settlement';

    case REFUND = 'refund';
}
