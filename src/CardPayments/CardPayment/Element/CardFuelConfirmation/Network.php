<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardFuelConfirmation;

/**
 * The card network used to process this card authorization.
 */
enum Network: string
{
    case VISA = 'visa';

    case PULSE = 'pulse';
}
