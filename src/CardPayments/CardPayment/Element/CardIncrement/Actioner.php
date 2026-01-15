<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardIncrement;

/**
 * Whether this authorization was approved by Increase, the card network through stand-in processing, or the user through a real-time decision.
 */
enum Actioner: string
{
    case USER = 'user';

    case INCREASE = 'increase';

    case NETWORK = 'network';
}
