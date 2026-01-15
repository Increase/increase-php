<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardFinancial;

/**
 * Whether this financial was approved by Increase, the card network through stand-in processing, or the user through a real-time decision.
 */
enum Actioner: string
{
    case USER = 'user';

    case INCREASE = 'increase';

    case NETWORK = 'network';
}
