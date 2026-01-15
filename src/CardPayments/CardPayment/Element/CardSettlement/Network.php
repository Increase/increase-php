<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement;

/**
 * The card network on which this transaction was processed.
 */
enum Network: string
{
    case VISA = 'visa';

    case PULSE = 'pulse';
}
