<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\ACHDecline;

/**
 * A constant representing the object's type. For this resource it will always be `ach_decline`.
 */
enum Type: string
{
    case ACH_DECLINE = 'ach_decline';
}
